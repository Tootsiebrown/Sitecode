<?php

namespace App;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [];

    public function getUrlAttribute()
    {
        return route('search', ['brand' => $this->id]);
    }

    public function brand()
    {
        return $this->hasMany(Listing::class);
    }
}
