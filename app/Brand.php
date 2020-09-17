<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [];

    public function getUrlAttribute()
    {
        return route('search', ['brand' => $this->id]);
    }
}
