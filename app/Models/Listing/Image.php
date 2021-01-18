<?php

namespace App\Models\Listing;

use App\HasDiskImage;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Listing\Image
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $listing_id
 * @property string $media_name
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
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @mixin \Eloquent
 */
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
