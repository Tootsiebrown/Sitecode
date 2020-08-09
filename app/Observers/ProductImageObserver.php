<?php

namespace App\Observers;

use App\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductImageObserver
{
    public function deleted(ProductImage $image)
    {
        Storage::disk($image->disk)->delete($image::DISK_PATH . $image->media_name);
        Storage::disk($image->disk)->delete($image::DISK_PATH . 'thumbs/' . $image->media_name);
    }
}
