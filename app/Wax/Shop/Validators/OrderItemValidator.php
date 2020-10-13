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
                    foreach($this->customizations as $customizationId => $customizationValue) {
                        $query->whereHas('customizations', function (Builder $query) use ($customizationId, $customizationValue) {
                            $query->where('customization_id', $customizationId)
                                ->where('value', $customizationValue);
                        });
                    }
                })
                ->sum('quantity');
        }

        $listingId = $this->customizations->first(fn($value, $key) => $key === 1);
        $offerId = $this->customizations->first(fn($value, $key) => $key === 2);
        if ($offerId) {
            if ($pendingQuantity > 0) {
                $this->errors()
                    ->add('quantity', 'You cannot alter the quantity of an accepted offer.');
                return false;
            }
            $effectiveInventory = Listing::withoutGlobalScopes()->find($listingId)->items()->reservedForOffer($offerId)->count();
        } else {
            $effectiveInventory = Listing::withoutGlobalScopes()->find($listingId)->availableItems->count() - $pendingQuantity;
        }

        if ($effectiveInventory < $this->quantity) {
            $this->errors()
                ->add('quantity', 'There is insufficient inventory available to fulfill your request.');
            return false;
        }

        return true;
    }
}
