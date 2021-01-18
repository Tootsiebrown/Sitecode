<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Media
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $ad_id
 * @property string|null $media_name
 * @property string|null $type
 * @property string|null $is_feature
 * @property string|null $storage
 * @property string|null $ref
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media query()
 * @mixin \Eloquent
 */
class Media extends Model
{
    protected $guarded = [];
}
