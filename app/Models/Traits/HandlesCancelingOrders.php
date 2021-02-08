<?php

namespace App\Models\Traits;

use App\Events\InventoryChangedEvent;
use App\Models\Listing\Item;
use App\User;
use App\Wax\Shop\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

trait HandlesCancelingOrders
{
    public function cancel(int $userId = null)
    {
        $affectedListings = $this->getAffectedListings();

        $itemsQuery = $this->getItemsQuery();

        $itemsQuery->update([
            'reserved_for_order_id' => null,
            'order_item_id' => null,
            'removed_at' => null,
            'reserved_for_offer_id' => null,
            'ebay_order_id' => null,
        ]);

        $this->canceled_by_user_id = $userId ?: Auth::user()->id;
        $this->canceled_at = Carbon::now()->toDateTimeString();
        $this->save();

        $affectedListings
            ->each(function ($listing) {
                event(new InventoryChangedEvent($listing));
            });
    }

    public function getCanceledAttribute()
    {
        return !is_null($this->canceled_at);
    }

    public function canceledBy()
    {
        return $this->belongsTo(User::class, 'canceled_by_user_id');
    }

    /**
     * @return \Illuminate\Support\Collection|mixed
     */
    private function getAffectedListings()
    {
        if ($this instanceof Order) {
            $affectedListings = $this->default_shipment->items
                ->pluck('listing')
                ->unique(fn($listing) => $listing->id);
        } else {
            $affectedListings = $this
                ->items()
                ->with('listing')
                ->get()
                ->pluck('listing')
                ->unique(fn($listing) => $listing->id);
        }

        return $affectedListings;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Support\Collection
     */
    private function getItemsQuery()
    {
        if ($this instanceof Order) {
            $itemsQuery = Item::whereIn(
                'id',
                $this
                    ->default_shipment
                    ->items
                    ->pluck('listingItems')
                    ->flatten()
                    ->pluck('id')
                    ->all()
            );
        } else {
            $itemsQuery = $this->items();
        }

        return $itemsQuery;
    }
}
