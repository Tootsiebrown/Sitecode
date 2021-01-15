<?php

namespace App\Wax\Shop\Models\Order;

use Wax\Shop\Models\Order\ShippingRate as WaxShippingRate;

/**
 * App\Wax\Shop\Models\Order\ShippingRate
 *
 * @property int $id
 * @property int $shipment_id
 * @property string $carrier
 * @property string $service_code
 * @property string $service_name
 * @property int|null $business_transit_days
 * @property string $amount
 * @property int $box_count
 * @property string|null $packaging
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float|null $actual_amount
 * @property-read \Wax\Shop\Models\Order\Shipment $shipment
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingRate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingRate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingRate query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingRate whereActualAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingRate whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingRate whereBoxCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingRate whereBusinessTransitDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingRate whereCarrier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingRate wherePackaging($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingRate whereServiceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingRate whereServiceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingRate whereShipmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingRate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ShippingRate extends WaxShippingRate
{
    protected $fillable = [
        'carrier',
        'service_name',
        'service_code',
        'business_transit_days',
        'amount',
        'actual_amount',
        'box_count',
        'packaging'
    ];
}
