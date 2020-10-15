<?php

namespace App;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Bid extends Model
{
    protected $guarded = [];

    public function posting_datetime()
    {
        $created_date_time = $this->created_at->timezone(get_option('default_timezone'))->format(get_option('date_format_custom') . ' ' . get_option('time_format_custom'));
        return $created_date_time;
    }

    public function getIsMineAttribute()
    {
        return Auth::check() && Auth::user()->id == $this->user_id;
    }

    public function scopeMine($query)
    {
        if (! Auth::check()) {
            return $query->whereRaw('1=0');
        }

        return $query->where('user_id', Auth::user()->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class)->withoutGlobalScopes();
    }
}
