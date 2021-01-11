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
            'condition' => $this->ebayCondition,
            'conditionsPolicy' => $this->getConditionsPolicy(),
            'aspects' => $this->getAspects(),
        ]);
    }

    protected function getCategories(int $parentId = null, $level = 1)
    {
        $ebayCategories = $this->ebay->getCategories($parentId)

            ->prepend('N/A', '');

        if ($ebayCategories->count() === 1) {
            return null;
        }

        return $ebayCategories;
    }

    public function getConditionsPolicy()
    {
        $lowestCategory = $this->getLowestCategory();

        if (! $lowestCategory) {
            return null;
        }

        $policy = $this->ebay->getConditionsPolicyForCategory($lowestCategory);

        if (! $policy) {
            return null;
        }

        // $policy is an ebay response like
        /*
        {
            +"categoryTreeId": "0"
            +"categoryId": "37935"
            +"itemConditionRequired": false
            +"itemConditions": array:11 [
                0 => {
                        +"conditionId": "2750"
                        +"conditionDescription": "Like New"
                }
                ...
            ]
        }
        */

        $policy = [
            'required' => $policy->itemConditionRequired,
            'conditions' => collect($policy->itemConditions)
                ->mapWithKeys(fn ($condition) => [$condition->conditionId => $condition->conditionDescription])
                ->filter(function ($conditionDescription, $conditionId) {
                    return $conditionId != 2000;
                    // see note at https://developer.ebay.com/api-docs/sell/inventory/resources/inventory_item/methods/createOrReplaceInventoryItem#request.condition
                    // not just anyone can use this condition.
                })
                ->when(
                    !$policy->itemConditionRequired,
                    fn($collection) => $collection->prepend('N/A', '')
                )
            ];

        return $policy;
    }

    protected function getAspects()
    {
        $lowestCategory = $this->getLowestCategory();

        if (! $lowestCategory) {
            return null;
        }

        $aspects = $this->ebay->getAspectsForCategory($lowestCategory);

        return $aspects;
    }

    protected function getLowestCategory()
    {
        return $this->ebayCategory7
            ?: $this->ebayCategory6
            ?: $this->ebayCategory5
            ?: $this->ebayCategory4
            ?: $this->ebayCategory3
            ?: $this->ebayCategory2
            ?: $this->ebayCategory1;
    }
}
