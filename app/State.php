<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\State
 *
 * @property int $id
 * @property string $state_name
 * @property int $country_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\City[] $cities
 * @property-read int|null $cities_count
 * @property-read \App\Country $country
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
 * @mixin \Eloquent
 */
class State extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
