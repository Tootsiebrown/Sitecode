<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Country
 *
 * @property int $id
 * @property string $country_code
 * @property string $country_name
 * @property string|null $capital
 * @property string|null $citizenship
 * @property string $country_code_number
 * @property string|null $currency
 * @property string|null $currency_code
 * @property string|null $currency_sub_unit
 * @property string|null $currency_symbol
 * @property int|null $currency_decimals
 * @property string|null $full_name
 * @property string $iso_3166_2
 * @property string $iso_3166_3
 * @property string $name
 * @property string $region_code
 * @property string $sub_region_code
 * @property int $eea
 * @property string|null $calling_code
 * @property string|null $flag
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\State[] $states
 * @property-read int|null $states_count
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @mixin \Eloquent
 */
class Country extends Model
{
    public function states()
    {
        return $this->hasMany(State::class);
    }
}
