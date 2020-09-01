<?php

namespace App\Models\Listing;

use App\HasDiskImage;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasDiskImage;

    protected $table = 'listing_images';
    protected $guarded = [];
}
