<?php

namespace App\Indexers;

use App\Repositories\ListingsRepository;
use Wax\SiteSearch\IndexingCoordinator;

class ListingsIndexer implements \Wax\SiteSearch\Contracts\IndexerContract
{
    /**
     * @var ListingsRepository
     */
    private ListingsRepository $repo;

    public function __construct(IndexingCoordinator $indexer, ListingsRepository $repo)
    {
        $this->indexer = $indexer;
        $this->repo = $repo;
        $this->goMap = config('wax.site-search.go_words');
    }



    public function crawl()
    {
        $items = $this->repo->getAll();

        foreach ($items as $item) {
            $content = $item->title
                . ' ' . $item->description
                . ' ' . $item->features
                . ' ' . $item->model_number
                . ' ' . $item->color
                . ' ' . ($item->brand ? $item->brand->name : '')
                . ' ' . $item->categories->pluck('name')->implode(' ');

            if (!empty($this->goMap)) {
                foreach ($this->goMap as $goTrigger => $goWord) {
                    if (stripos($content, $goTrigger) !== false) {
                        $content .= ' ' . $goWord;
                        unset($this->goMap[$goTrigger]);
                    }
                }
            }

            $page = array(
                'module' => 'listings',
                'url' => $item->url,
                'title' => $item->title,
                'content' => $content,
                'description' => strip_tags($item->description),
            );

            $this->indexer->processPage($page);
        }
    }
}
