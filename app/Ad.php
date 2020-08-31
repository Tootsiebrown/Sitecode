<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ad extends Model
{
    use HasCondition;
    use HasProductCategories;

    protected $casts = [
        'expired_at' => 'datetime',
        'price' => 'float',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function scopeActive($query)
    {
        return $query->whereStatus('1');
    }

    public function scopeInCategory($query, $categoryId)
    {
        if (is_int($categoryId)) {
            return $query->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('product_categories.id', $categoryId);
            });
        } elseif (is_array($categoryId)) {
            return $query->whereHas('categories', function ($query) use ($categoryId) {
                $query->whereIn('product_categories.id', $categoryId);
            });
        }
    }

    public function scopeExpired($query)
    {
        return $query->where('expired_at', '<=', Carbon::now()->toDateTimeString());
    }

    public function scopeTypeIsAuction($query)
    {
        return $query->where('type', 'auction');
    }

    public function scopeEndEventNotFired($query)
    {
        return $query->where('end_event_fired', false);
    }

    public function getFeaturedImageAttribute()
    {
        return $this->images()->orderBy('featured', 'desc')->first();
    }

    public function images()
    {
        return $this->hasMany(AdImage::class);
    }

    /**
     * @return bool
     */

    public function is_published()
    {
        if ($this->status == 1) {
            return true;
        }
        return false;
    }

    public function full_address()
    {
        $location = '';

        if ($this->address != '') {
            $location .= $this->address . ", ";
        }
        if ($this->city != '') {
            $location .= '<br />' . $this->city->city_name;
        }
        if ($this->state != '') {
            $location .= ' ' . $this->state->state_name;
        }
        if ($this->country != '') {
            $location .= '<br />' . $this->country->country_name;
        }
        return safe_output($location);
    }

    public function posting_datetime()
    {
        $created_date_time = $this->created_at->timezone(get_option('default_timezone'))->format(get_option('date_format_custom') . ' ' . get_option('time_format_custom'));
        return $created_date_time;
    }

    public function posted_date()
    {
        $created_date_time = $this->created_at->timezone(get_option('default_timezone'))->format(get_option('date_format_custom'));
        return $created_date_time;
    }


    public function status_context()
    {
        $status = $this->status;
        $html = '';
        switch ($status) {
            case 0:
                $html = '<span class="text-muted">' . trans('app.pending') . '</span>';
                break;
            case 1:
                $html = '<span class="text-success">' . trans('app.published') . '</span>';
                break;
            case 2:
                $html = '<span class="text-warning">' . trans('app.blocked') . '</span>';
                break;
        }
        return $html;
    }

    public function is_my_favorite()
    {
        if (! Auth::check()) {
            return false;
        }
        $user = Auth::user();

        $favorite = Favorite::whereUserId($user->id)->whereAdId($this->id)->first();
        if ($favorite) {
            return true;
        } else {
            return false;
        }
    }

    public function bids()
    {
        return $this->hasMany(Bid::class)->orderBy('id', 'desc');
    }

    public function bid_deadline()
    {
        if ($this->expired_at) {
            $dt = Carbon::createFromTimestamp(strtotime($this->expired_at));
            $deadline = $dt->timezone(get_option('default_timezone'))->format(get_option('date_format_custom'));
            return $deadline;
        }
        return false;
    }
    public function bid_deadline_left()
    {
        if ($this->expired_at) {
            $dt = Carbon::createFromTimestamp(strtotime($this->expired_at));
            $deadline = $dt->diffForHumans();
            return $deadline;
        }
        return false;
    }

    public function current_bid() : float
    {
        $last_bid = $this->price;

        $get_last_bid = Bid::whereAdId($this->id)->max('bid_amount');
        if ($get_last_bid && $get_last_bid > $last_bid) {
            $last_bid = $get_last_bid;
        }
        return $last_bid;
    }

    public function getWinningBidAttribute()
    {
        return $this->bids->sortByDesc('bid_amount')->first();
    }

    public function is_bid_active()
    {
        if ($this->type == 'auction'
            && $this->expired_at->isPast()
        ) {
            return false;
        }

        return true;
    }

    public function is_bid_accepted()
    {
        if ($this->type == 'auction' && $this->bids->isNotEmpty()) {
            return true;
        }

        return false;
    }

    public function premium_icon()
    {
        if ($this->price_plan == 'premium') {
            $html = '<img src="' . asset('assets/img/premium-icon.png') . '" alt="" />';
            return $html;
        }
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'ad_category_links', 'ad_id', 'category_id');
    }

    public static function getOptionalFieldsForDisplay()
    {
        return [
            'gender' => 'Gender',
            'model_number' => 'Model Number',
            'color' => 'Color',
            'expiration_date' => 'Expiration Date',
            'dimensions' => 'Dimensions',
            'size' => 'Size',
        ];
    }

    public function hasOptionalFieldsForDisplay()
    {
        foreach (static::getOptionalFieldsForDisplay() as $fieldName => $fieldLabel) {
            if (!is_null($this->$fieldName)) {
                return true;
            }
        }

        return false;
    }

    public function getUrlAttribute()
    {
        return route('single_ad', [
            'id' => $this->id,
            'slug' => $this->slug,
        ]);
    }
}
