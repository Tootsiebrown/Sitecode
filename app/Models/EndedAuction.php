<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class EndedAuction extends Model
{
    protected $guarded = [];

    public function listing()
    {
        return $this->belongsTo(Listing::class)->withoutGlobalScopes();
    }

    public function markPurchased()
    {
        $this->purchased_at = Carbon::now()->toDateTimeString();
        $this->save();
    }
}
