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
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereBackgroundImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereBackgroundImageMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereCmsSortId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereCta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereImageMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slide whereUrl($value)
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
