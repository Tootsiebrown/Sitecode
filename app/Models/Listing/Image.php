<?php

namespace App\Models\Listing;

use App\HasDiskImage;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasDiskImage;

    protected $table = 'listing_images';
    protected $guarded = [];

    public static function getDiskPath()
    {
        return 'uploads/listings/';
    }

    public static function getUrlPath()
    {
        return 'storage/uploads/listings/';
    }
}
