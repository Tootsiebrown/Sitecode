<?php

namespace App\Models;

use App\Models\Casts\Image;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $guarded = [];

    public function getFilePath($field)
    {
        return $this->getTable() . '/' . $field;
    }

    public function getImageAttribute($value)
    {
        return $this->getAsImage('image', $value);
    }

    public function getBackgroundImageAttribute($value)
    {
        return $this->getAsImage('background_image', $value);
    }

    protected function getAsImage($attribute, $value)
    {
        $metaAttribute = "{$attribute}_metadata";

        return new Image($value, $this->getFilePath($attribute), $this->$metaAttribute);
    }
}
