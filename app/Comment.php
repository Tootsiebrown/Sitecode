<?php

namespace App;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Comment
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
 * @property-read Listing|null $ad
 * @property-read \App\User|null $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ChildComment[] $childs_approved
 * @property-read int|null $childs_approved_count
 * @method static \Illuminate\Database\Eloquent\Builder|Comment approved()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment parent()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereAdId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereAuthorEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereAuthorIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereAuthorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserId($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    protected $guarded = [];

    public function scopeApproved($query)
    {
        return $query->whereApproved('1');
    }

    public function scopeParent($query)
    {
        return $query->whereCommentId(0);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function childs_approved()
    {
        return $this->hasMany(ChildComment::class, 'comment_id', 'id')->whereApproved('1')->orderBy('id', 'desc');
    }

    public function created_at_datetime()
    {
        $created_date_time = $this->created_at->timezone(get_option('default_timezone'))->format(get_option('date_format_custom') . ' ' . get_option('time_format_custom'));
        return $created_date_time;
    }

    public function ad()
    {
        return $this->belongsTo(Listing::class);
    }
}
