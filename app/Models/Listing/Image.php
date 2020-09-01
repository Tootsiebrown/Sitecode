<?php

namespace App\Models\Listing;

use App\HasDiskImage;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'listing_images';
    use HasDiskImage;

    protected $guarded = [];
}
