<?php

namespace App;

use Illuminate\Support\Facades\Storage;

trait HasDiskImage
{
    public static function getDiskPath()
    {
        return 'uploads/images/';
    }

    public static function getUrlPath()
    {
        return 'storage/uploads/images/';
    }

    public function getUrlAttribute()
    {
        if (Storage::disk($this->disk)->exists(static::getDiskPath() . $this->media_name)) {
            return asset(static::getUrlPath() . $this->media_name);
        } else {
            return $this->getPlaceholderUrl();
        }
    }

    public function getThumbUrlAttribute()
    {
        if (Storage::disk($this->disk)->exists(static::getDiskPath() . $this->media_name)) {
            return asset(static::getUrlPath() . $this->media_name);
        } else {
            return $this->getPlaceholderUrl();
        }
    }

    protected function getPlaceholderUrl()
    {
        return asset('assets/img/classified-placeholder.png');
    }
}
