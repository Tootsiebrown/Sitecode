<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $guarded = [];

    const URL_PATH = 'storage/uploads/images/';
    const STORAGE_PATH = 'app/public/uploads/images/';

    public function getUrlAttribute()
    {
        if (file_exists(storage_path(self::STORAGE_PATH . $this->media_name))) {
            return asset(static::URL_PATH . $this->media_name);
        } else {
            return $this->getPlaceholderUrl();
        }
    }

    public function getThumbUrlAttribute()
    {
        if (file_exists(storage_path(self::STORAGE_PATH . $this->media_name))) {
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
