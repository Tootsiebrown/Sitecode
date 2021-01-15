<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\City
 *
 * @property int $id
 * @property string $city_name
 * @property int $state_id
 * @property-read \App\State $state
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @mixin \Eloquent
 */
class City extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
