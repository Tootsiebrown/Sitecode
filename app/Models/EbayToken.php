<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EbayToken
 *
 * @property int $id
 * @property string $access_token
 * @property \Illuminate\Support\Carbon $access_token_expires_at
 * @property string $refresh_token
 * @property \Illuminate\Support\Carbon $refresh_token_expires_at
 * @method static \Illuminate\Database\Eloquent\Builder|EbayToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EbayToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EbayToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|EbayToken whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EbayToken whereAccessTokenExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EbayToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EbayToken whereRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EbayToken whereRefreshTokenExpiresAt($value)
 * @mixin \Eloquent
 */
class EbayToken extends Model
{
    protected $casts = [
        'access_token_expires_at' => 'datetime',
        'refresh_token_expires_at' => 'datetime',
    ];
    protected $guarded = [];
    public $timestamps = false;
}
