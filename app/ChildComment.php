<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ChildComment
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $ad_id
 * @property int|null $comment_id
 * @property string|null $author_name
 * @property string|null $author_email
 * @property string|null $author_ip
 * @property string|null $comment
 * @property string|null $approved
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $author
 * @method static \Illuminate\Database\Eloquent\Builder|ChildComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChildComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChildComment query()
 * @mixin \Eloquent
 */
class ChildComment extends Model
{
    protected $table = 'comments';

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
