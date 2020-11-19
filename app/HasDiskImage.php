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
        if (Storage::disk($this->disk)->exists(static::getDiskPath() . 'cropped/' . $this->media_name)) {
            return asset(static::getUrlPath() . 'cropped/' . $this->media_name);
        }

        return $this->raw_url;
    }

    public function getRawUrlAttribute()
    {
        if (Storage::disk($this->disk)->exists(static::getDiskPath() . $this->media_name)) {
            return asset(static::getUrlPath() . $this->media_name);
        } else {
            return $this->getPlaceholderUrl();
        }
    }

    public function getThumbUrlAttribute()
    {
        if (Storage::disk($this->disk)->exists(static::getDiskPath() . 'cropped/thumbs/' . $this->media_name)) {
            return asset(static::getUrlPath() . 'cropped/thumbs/' . $this->media_name);
        } elseif (Storage::disk($this->disk)->exists(static::getDiskPath() . $this->media_name)) {
            return asset(static::getUrlPath() . 'thumbs/' . $this->media_name);
        } else {
            return $this->getPlaceholderUrl();
        }
    }

    public function getFilePathAttribute()
    {
        return Storage::disk($this->disk)->path(static::getDiskPath() . $this->media_name);
    }

    public function getCroppedFilePathAttribute()
    {
        return Storage::disk($this->disk)->path(static::getDiskPath() . 'cropped/' . $this->media_name);
    }

    public function getThumbFilePathAttribute()
    {
        return Storage::disk($this->disk)->path(static::getDiskPath() . 'thumbs/' . $this->media_name);
    }

    protected function getPlaceholderUrl()
    {
        return asset('assets/img/classified-placeholder.png');
    }

    public function getHeightAttribute()
    {
        if (Storage::disk($this->disk)->exists(static::getDiskPath() . $this->media_name)) {
            return getimagesize(Storage::disk($this->disk)->path(static::getDiskPath() . $this->media_name))[1];
        }

        return null;
    }

    public function getWidthAttribute()
    {
        if (Storage::disk($this->disk)->exists(static::getDiskPath() . $this->media_name)) {
            return getimagesize(Storage::disk($this->disk)->path(static::getDiskPath() . $this->media_name))[0];
        }

        return null;
    }
}
