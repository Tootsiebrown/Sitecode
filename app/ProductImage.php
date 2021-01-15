<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductImage
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $media_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $featured
 * @property string $disk
 * @property string|null $metadata
 * @property int|null $sort_id
 * @property-read mixed $cropped_file_path
 * @property-read mixed $file_path
 * @property-read mixed $height
 * @property-read mixed $raw_url
 * @property-read mixed $thumb_file_path
 * @property-read mixed $thumb_url
 * @property-read mixed $url
 * @property-read mixed $width
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereMediaName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereSortId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductImage extends Model
{
    use HasDiskImage;

    protected $guarded = [];
}
