<?php

namespace App\Models\Listing;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Listing\EbayAspect
 *
 * @property int $id
 * @property int $listing_id
 * @property string $name
 * @property string $cardinality
 * @property-read Collection|EbayAspectValue[] $values
 * @property-read int|null $values_count
 * @method static Builder|EbayAspect newModelQuery()
 * @method static Builder|EbayAspect newQuery()
 * @method static Builder|EbayAspect query()
 * @mixin \Eloquent
 */
class EbayAspect extends Model
{
    protected $table = 'listing_ebay_aspects';
    public $timestamps = false;
    public $guarded = [];

    public function values()
    {
        return $this->hasMany(EbayAspectValue::class, 'aspect_id');
    }
}
