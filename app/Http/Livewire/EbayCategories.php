<?php

namespace App\Http\Livewire;

use App\Ebay\Sdk;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
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
    }

    public function updating($name, $value)
    {
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
        ]);
    }

    protected function getCategories(int $parentId = null, $level = 1)
    {
        $key = '';
        if ($parentId) {
            $key .= $parentId;
        } else {
            $key .= 'null';
        }

        $key .= $level;

        return Cache::remember(
            $key,
            Carbon::now()->addDays(30),
            function() use ($parentId, $level) {
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
}
