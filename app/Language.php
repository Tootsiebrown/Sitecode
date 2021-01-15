<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Language
 *
 * @property int $id
 * @property string|null $language_name
 * @property string|null $language_code
 * @property int|null $is_rtl
 * @method static \Illuminate\Database\Eloquent\Builder|Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Language query()
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereIsRtl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereLanguageCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereLanguageName($value)
 * @mixin \Eloquent
 */
class Language extends Model
{
    protected $guarded = [];
    public $timestamps = false;
}
