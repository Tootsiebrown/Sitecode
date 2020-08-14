<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdImage extends Model
{
    use HasDiskImage;

    protected $guarded = [];
}
