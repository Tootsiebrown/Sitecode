<?php

namespace App\Models;

use App\Models\Casts\Image;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Slide
 *
 * @property int $id
 * @property string $image
 * @property string $url
 * @property string $title
 * @property string $caption
 * @property int|null $cms_sort_id
 * @property string $cta
 * @property string $image_metadata
 * @property string|null $background_image
 * @property string|null $background_image_metadata
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Slide newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slide newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slide query()
 * @mixin \Eloquent
 */
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
