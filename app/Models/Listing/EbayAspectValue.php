<?php

namespace App\Models\Listing;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Listing\EbayAspectValue
 *
 * @property int $id
 * @property int $aspect_id
 * @property string $value
 * @property-read Collection|EbayAspectValue[] $values
 * @property-read int|null $values_count
 * @method static Builder|EbayAspectValue newModelQuery()
 * @method static Builder|EbayAspectValue newQuery()
 * @method static Builder|EbayAspectValue query()
 * @mixin \Eloquent
 */
class EbayAspectValue extends Model
{
    protected $table = 'listing_ebay_aspect_values';
    public $timestamps = false;
    public $guarded = [];

    public function values()
    {
        return $this->hasMany(EbayAspectValue::class, 'aspect_id');
    }
}
