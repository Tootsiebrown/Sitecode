<?php

namespace App\Repositories;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Wax\SiteSearch\Repositories\SiteSearchRepository as WaxSiteSearchRepository;

class SiteSearchRepository extends WaxSiteSearchRepository
{
    /**
     * Search the index for the given query expression and return an array of pages.
     *
     * @param string query
     * @param int page page number for paginated results
     * @param int perPage number of results to return
     * @param string module limit results to a single module
     */
    public function search($query, $page = 1, $perPage = 10, $module = null, $excludedModules = [])
    {
        if ($page < 1) {
            $page = 1;
        }

        if ($module && !is_array($module)) {
            $module = [$module];
        }

        $query = Str::lower($query);

        $stems = preg_split('/[\s]+/u', $query);

        $tempStems = $stems;
        $stems = [];

        // Keywords array should include hyphenated compound words + each of
        // the individual components separately. This will allow increased
        // relevance weight for exact matches.
        foreach ($tempStems as $stem) {
            $stems[] = $stem;
            $parts = explode('-', $stem);
            if (count($parts) > 1) {
                $stems = array_merge($stems, $parts);
            }
        }

        $stems = array_map(
            function ($str) {
                return $this->stemmer->stem(preg_replace('/[^a-z0-9]/iu', '', $str), true);
            },
            $stems
        );
        $stems = array_filter($stems);

        /**
         * A match for a term is based on the following criteria:
         * (`stem` in ($stemStr) or `word` rlike "{$rlikeTerms}").
         *
         * 1. A stem can be an exact match for a stem from the input
         * 2. A word can be a partial match for a stem from the input
         */
        $likeStems = collect($stems)
            ->filter(function ($stem) {
                return Str::length($stem) > 1;
            });

        // get all the related word forms
        $words = DB::table('search_words_forms')
            ->select('word')
            ->whereIn("stem", $stems)
            ->orWhere(function ($query) use ($likeStems) {
                $likeStems->each(function ($stem) use ($query) {
                    $query->orWhere('word', 'like', "$stem%");
                });
            })
            ->get()
            ->pluck('word')
            ->filter(function ($word) {
                return Str::length($word) > 1;
            })
            ->toArray();

        $delims = [];
        for ($i = 0; $i < count($words); ++$i) {
            $delims[] = '/';
        }
        $wordStr = implode('|', array_map('preg_quote', $words, $delims));
        $queryStr = implode(',', preg_split('/[\s]+/u', preg_replace("/[^\/[:alnum:][:space:]]/u", ' ', $query)));
        $moduleStr = $module && count($module) ? 'and p.module IN (' . Builder::glue($module, ', ') . ')' : '';
        $excludedModulesStr = $excludedModules && count($excludedModules) ? ' AND p.module NOT IN (' . Builder::glue($excludedModules, ',') . ') ' : '';

        $searchPages = DB::table('search_pages')
            ->join('search_pages_words', 'search_pages.id', '=', 'search_pages_words.page_id')
            ->join('search_words_forms', 'search_words_forms.stem', '=', 'search_pages_words.stem')
            ->select('search_pages.url as url', 'search_pages.module as module')
            ->whereIn('search_pages_words.stem', $stems)
            ->orWhere(function ($query) use ($likeStems) {
                $likeStems->each(function ($stem) use ($query) {
                    $query->orWhere('word', 'like', "$stem%");
                });
            })
            ->groupBy('search_pages_words.page_id');

        $modules = DB::table(DB::raw('(' . $searchPages->toSql() . ') as subquery'))
            ->mergeBindings($searchPages)
            ->select(DB::raw('count(url) as `count`'), 'module')
            ->groupBy('module')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->module => $item->count];
            });

        // The following is a hack for sqlite compatibility when running tests
        if (app()->make(Builder::class)->connection->getDriverName() !== 'mysql') {
            $weightSelect = DB::raw('(sum(search_pages_words.`weight`)) as `weight`');
        } else {
            $weightSelect = DB::raw('(sum(find_in_set(search_words_forms.`word`, "' . $queryStr . '")) + sum(search_pages_words.`weight`)) as `weight`');
        }

        $dbQuery = DB::table('search_pages')
            ->join('search_pages_words', 'search_pages.id', '=', 'search_pages_words.page_id')
            ->join('search_words_forms', 'search_words_forms.stem', '=', 'search_pages_words.stem')
            ->select(
                $weightSelect,
                'search_pages.module',
                'search_pages.url',
                'search_pages.content',
                'search_pages.title',
                DB::raw('sum(search_pages_words.count) as `count`')
            )
            ->where(function ($query) use ($stems, $likeStems) {
                $query->whereIn('search_pages_words.stem', $stems);
                $likeStems->each(function ($stem) use ($query) {
                    $query->orWhere('search_words_forms.word', 'like', "$stem%");
                });
            })
            ->groupBy(
                'search_pages_words.page_id',
            )
            ->orderBy('weight', 'desc')
            ->offset((int) (($page - 1) * $perPage))
            ->limit($perPage);

        if ($module && count($module)) {
            $dbQuery->whereIn('search_pages.module', $module);
        }
        if ($excludedModules && count($excludedModules)) {
            $dbQuery->whereNotIn('search_pages.module', $excludedModules);
        }

        $rows = $dbQuery
            ->get()
            ->map(function ($row) use ($wordStr) {
                $row->url = (0 === strpos($row->url, 'http') ? $row->url : '/' . ltrim($row->url, '/'));

                // build a hilighted excerpt paragraph
                $pattern = '.{0,50}?(' . $wordStr . ').{0,200}';
                if (mb_eregi($pattern, $row->content, $match)) {
                    $excerpt = $match[0];
                    $unBoldedExcerpt = preg_replace('/<\/?strong>/', '', $excerpt);

                    if (strpos(strrev($row->content), strrev($unBoldedExcerpt)) !== 0) {
                        $excerpt .= '&hellip;';
                    }
                    if (strpos($row->content, $unBoldedExcerpt) !== 0) {
                        $excerpt = '&hellip;' . $excerpt;
                    }

                    $row->excerpt = $excerpt;
                } else {
                    $row->excerpt = Str::limit($row->content, 250);
                }

                $row->excerpt = preg_replace('/(' . $wordStr . ')/iu', '<strong>\1</strong>', $row->excerpt);

                return (array) $row;
            });

        // format the return values
        $results = array(
            'totalCount' => $modules->sum(),
            'count' => $rows->count(),
            'modules' => $modules->toArray(),
            'results' => $rows->toArray(),
        );

        // save to the search log
        DB::insert(
            'insert into search_history (`query`, `results`, `timestamp`) values(:query, :results, :timestamp)',
            [
                'query' => $query,
                'results' => $rows->count(),
                'timestamp' => time(),
            ]
        );

        return $results;
    }
}
