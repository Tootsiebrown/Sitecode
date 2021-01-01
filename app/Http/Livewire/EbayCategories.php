<?php

namespace App\Http\Livewire;

use App\Ebay\Sdk;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class EbayCategories extends Component
{
    /** @var Sdk */
    private $ebay;

    public $ebayCategory1 = null;
    public $ebayCategory2 = null;
    public $ebayCategory3 = null;
    public $ebayCategory4 = null;
    public $ebayCategory5 = null;
    public $ebayCategory6 = null;
    public $ebayCategory7 = null;
    public $ebayCondition = null;

    public function __construct($id)
    {
        parent::__construct($id);

        $this->ebay = app()->make(Sdk::class);
    }

    public function mount(Sdk $ebay)
    {
        $this->ebay = $ebay;

        $this->ebayCategory1 = old('ebay_category_1');
        $this->ebayCategory2 = old('ebay_category_2');
        $this->ebayCategory3 = old('ebay_category_3');
        $this->ebayCategory4 = old('ebay_category_4');
        $this->ebayCategory5 = old('ebay_category_5');
        $this->ebayCategory6 = old('ebay_category_6');
        $this->ebayCategory7 = old('ebay_category_7');
        $this->ebayCondition = old('ebay_condition');
    }

    public function updating($name, $value)
    {
        if (strpos($name, 'ebayCategory') !== 0) {
            return;
        }

        $key = substr($name, -1);

        for ($i = 1; $i <= 7; $i++) {
            if ($i > $key) {
                $propertyName = "ebayCategory${i}";
                $this->$propertyName = null;
            }
        }
    }

    public function render()
    {
        return view('livewire.ebay-categories', [
            'level1Categories' => $this->getCategories(),
            'level2Categories' => $this->ebayCategory1 ? $this->getCategories($this->ebayCategory1, 2) : null,
            'level3Categories' => $this->ebayCategory2 ? $this->getCategories($this->ebayCategory2, 3) : null,
            'level4Categories' => $this->ebayCategory3 ? $this->getCategories($this->ebayCategory3, 4) : null,
            'level5Categories' => $this->ebayCategory4 ? $this->getCategories($this->ebayCategory4, 5) : null,
            'level6Categories' => $this->ebayCategory5 ? $this->getCategories($this->ebayCategory5, 6) : null,
            'level7Categories' => $this->ebayCategory6 ? $this->getCategories($this->ebayCategory6, 7) : null,
            'conditions' => $this->getConditions(),
        ]);
    }

    protected function getCategories(int $parentId = null, $level = 1)
    {
        $key = 'ebay-categories:';
        if ($parentId) {
            $key .= $parentId;
        } else {
            $key .= 'null';
        }

        $key .= ','.$level;

        return Cache::remember(
            $key,
            Carbon::now()->addDays(30),
            function () use ($parentId, $level) {
                $ebayCategories = $this->ebay->getCategories($parentId, $level)
                    ->filter(fn($category) => $category->CategoryID != $parentId)
                    ->mapWithKeys(fn($cat) => [$cat->CategoryID => $cat->CategoryName])
                    ->prepend('N/A', '');

                if ($ebayCategories->count() === 1) {
                    return null;
                }

                return $ebayCategories;
            }
        );
    }

    public function getConditions()
    {
        $lowestCategory = $this->ebayCategory7
            ?: $this->ebayCategory6
            ?: $this->ebayCategory5
            ?: $this->ebayCategory4
            ?: $this->ebayCategory3
            ?: $this->ebayCategory2
            ?: $this->ebayCategory1;

        if (! $lowestCategory) {
            return collect();
        }

        $feature = 'ConditionValues';

        $key = 'ebay-category-features:' . $lowestCategory . ',' . $feature;

        return Cache::remember(
            $key,
            Carbon::now()->addDays(30),
            function () use ($lowestCategory, $feature) {
                $response = $this->ebay->getEbayCategoryFeatures($lowestCategory, [$feature]);
                if ($response->Ack !== 'Success') {
                    throw new Exception(
                        'error getting category features for category '
                        . $lowestCategory
                        . ' with features '
                        . $feature
                    );
                }

                if (!empty($response->Category)) {
                    if (is_array($response->Category)) {
                        if (current($response->Category)->CategoryID == $lowestCategory) {
                            return collect(current($response->Category)->ConditionValues->Condition);
                        }
                    } elseif ($response->Category->CategoryID == $lowestCategory) {
                        return collect($response->Category->ConditionValues->Condition);
                    }

                    return collect();
                } else {
                    return collect();
                }
            }
        )
        ->mapWithKeys(fn($condition) => [$condition->ID => $condition->DisplayName]);
    }
}
