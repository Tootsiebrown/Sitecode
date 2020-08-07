<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    protected $guarded = [];

    const URL_PATH = 'storage/uploads/images/';
    const DISK_PATH = 'uploads/images/';

    public function getUrlAttribute()
    {
        if (Storage::disk($this->disk)->exists(static::DISK_PATH . $this->media_name)) {
            return asset(static::URL_PATH . $this->media_name);
        } else {
            return $this->getPlaceholderUrl();
        }
    }

    public function getThumbUrlAttribute()
    {
        if (Storage::disk($this->disk)->exists(static::DISK_PATH . $this->media_name)) {
            return asset(static::URL_PATH . $this->media_name);
        } else {
            return $this->getPlaceholderUrl();
        }
    }

    protected function getPlaceholderUrl()
    {
        return asset('assets/img/classified-placeholder.png');
    }
}
