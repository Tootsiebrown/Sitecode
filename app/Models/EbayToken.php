<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EbayToken extends Model
{
    protected $casts = [
        'access_token_expires_at' => 'datetime',
        'refresh_token_expires_at' => 'datetime',
    ];
    protected $guarded = [];
    public $timestamps = false;
}
