<?php

namespace App\Wax\Shop\Validators;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Builder;
use Wax\Shop\Facades\ShopServiceFacade;
use Wax\Shop\Models\Product;

class OrderItemValidator extends \Wax\Shop\Validators\OrderItemValidator
{
    /**
     * Check inventory availability for the requested Product & Options
     *
     * @param Product $product
     * @return bool
     */
    protected function checkInventory(Product $product): bool
    {
        if ($this->itemId) {
            // this is already in the cart, don't double the pending quantity
            $pendingQuantity = $this->quantity - $this->item->quantity;
        } else {
            // How many are already in the user's cart?
            $pendingQuantity = ShopServiceFacade::getActiveOrder()
                ->default_shipment
                ->items()
                ->where('product_id', $product->id)
                ->when($this->customizations->isNotEmpty(), function ($query) {
                    $query->whereHas('customizations', function (Builder $query) {
                        foreach ($this->customizations as $customizationId => $customizationValue) {
                            if ($customizationId === 1) {
                                $query->where('customization_id', $customizationId)
                                    ->where('value', $customizationValue);
                            }
                        }
                    });
                })
                ->sum('quantity');
        }

        $relevantCustomization = $this->customizations->first(fn($value, $key) => $key === 1);
        $effectiveInventory = Listing::find($relevantCustomization)->availableItems->count() - $pendingQuantity;

        if ($effectiveInventory < $this->quantity) {
            $this->errors()
                ->add('quantity', 'There is insufficient inventory available to fulfill your request.');
            return false;
        }

        return true;
    }
}
