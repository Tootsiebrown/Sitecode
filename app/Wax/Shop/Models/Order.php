<?php

namespace App\Wax\Shop\Models;

use Wax\Shop\Models\Bundle;
use Wax\Shop\Models\Order as WaxOrder;
use App\Wax\Shop\Models\Order\Shipment;

class Order extends WaxOrder
{
    public function shipments()
    {
        return $this->hasMany(Shipment::class)->orderBy('id', 'asc');
    }

    public function validateShipping(): bool
    {
        if (!$this->shipments->count()) {
            return false;
        }

        // fulfillment will add shipping later,
        return true;
    }

    protected function applyBundleDiscounts()
    {
        $orderProductIds = $this->items->pluck('product_id');

        $bundles = Bundle::whereHas('products', function ($query) use ($orderProductIds) {
            $query->whereIn('wax_products.id', $orderProductIds);
        })->orderBy('percent', 'desc')->get();

        $bundlesTouched = $bundles->filter(function ($bundle) use ($orderProductIds) {
            return $bundle->products->count() == $orderProductIds->intersect($bundle->products->pluck('id'))->count();
        })->each(function ($bundle) {
            $items = $this->items
                ->where('discount_amount', 0)
                ->wherein('product_id', $bundle->products->pluck('id'));

            if ($items->isEmpty()) {
                return;
            }

            $orderBundle = $this->bundles()->create([
                'name' => $bundle->name,
                'percent' => $bundle->percent,
            ]);
            $orderBundle->items()->saveMany($items);

            $items->each(function ($item) use ($orderBundle) {
                $item->discount_amount = round($item->gross_subtotal * $orderBundle->percent / 100, 2);
                $item->bundle_id = $orderBundle->id;
                $item->save();
            });

            $orderBundle->refresh();
            $orderBundle->calculated_value = $orderBundle->items->sum('discount_amount');
            $orderBundle->save();

            $this->refresh();
        })->count();

        return $bundlesTouched;
    }
}
