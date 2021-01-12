<?php

namespace App\Models;

use App\Bid;
use App\Brand;
use App\City;
use App\Country;
use App\Favorite;
use App\HasCondition;
use App\HasProductCategories;
use App\Models\Listing\Image;
use App\Models\Listing\Item;
use App\ProductCategory;
use App\State;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Listing extends Model
{
    use HasCondition;
    use HasProductCategories;

    protected $casts = [
        'expired_at' => 'datetime',
        'price' => 'float',
        'featured' => 'boolean',
        'offers_enabled' => 'boolean',
    ];

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('withInventory', function (Builder $query) {
            $query->has('availableItems');
        });

        static::addGlobalScope('activeIfAuction', function (Builder $query) {
            $query->where(function ($query) {
                $query->orWhere('type', 'set-price');
                $query->orWhere(function ($query) {
                    $query->where('type', 'auction');
                    $query->where('expired_at', '>=', Carbon::now()->toDateTimeString());
                });
            });
        });

        static::addGlobalScope('notSecret', function (Builder $query) {
            $query->where('secret', false);
        });
    }

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

    public function scopeOfBrand($query, $brandId)
    {
        return $query->where('brand_id', $brandId);
    }

    public function scopeThatIBidFor($query)
    {
        if (! Auth::check()) {
            return $query;
        }

        return $query->whereHas('bids', function ($query) {
            return $query->where('user_id', Auth::user()->id);
        });
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1)
            ->orderBy('featured_sort_id');
    }

    public function scopeReadyForEbay($query)
    {
        return $query->notYetSentToEbay()
            ->where('send_to_ebay', 1)
            ->withoutGlobalScope('notSecret')
            ->where('type', 'set-price')
            ->timePastForEbay();
    }

    public function scopeNotYetSentToEbay($query)
    {
        return $query->whereNull('sent_to_ebay_at');
    }

    public function scopeTimePastForEbay($query)
    {
        return $query->where('send_to_ebay_at', '<', Carbon::now()->toDateTimeString());
    }

    public function getFeaturedImageAttribute()
    {
        return $this->images->sortByDesc('featured')->first();
    }

    public function images()
    {
        return $this
            ->hasMany(Image::class)
            ->orderBy('sort_id');
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

        $favorite = Favorite::where('user_id', $user->id)->where('listing_id', $this->id)->first();
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
            $deadline = $dt->timezone(get_option('default_timezone'))->format('F j, Y \a\t g:ia T');
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

    public function current_bid(): float
    {
        $last_bid = $this->price;

        $get_last_bid = $this->bids()->max('bid_amount');
        if ($get_last_bid && $get_last_bid > $last_bid) {
            $last_bid = $get_last_bid;
        }
        return $last_bid;
    }

    public function getWinningBidAttribute()
    {
        return $this->bids->sortByDesc('bid_amount')->first();
    }

    public function getIsBiddingActiveAttribute()
    {
        if (
            $this->type == 'auction'
            && $this->expired_at->isPast()
        ) {
            return false;
        }

        return true;
    }

    public function is_bid_accepted()
    {
        if (
            $this->type == 'auction'
            && $this->bids->isNotEmpty()
            && $this->ended
        ) {
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

    public function items()
    {
        return $this->hasMany(Item::class, 'listing_id');
    }

    public function getIsAuctionAttribute(): bool
    {
        return $this->type === 'auction';
    }

    public function getIsSetPriceAttribute(): bool
    {
        return $this->type === 'set-price';
    }

    public function getQuantityAttribute(): int
    {
        return $this->items->count();
    }

    public function availableItems()
    {
        return $this->items()->available();
    }

    public function getHasAvailableItemsAttribute()
    {
        return $this->availableItems->count() > 0;
    }

    public function getEndedAttribute(): bool
    {
        return $this->expired_at->lt(Carbon::now());
    }

    public function getIWonAttribute()
    {
        return $this->is_auction && $this->ended && $this->winning_bid->is_mine;
    }

    public function getMyMostRecentBidAttribute()
    {
        return $this->bids()->mine()->orderBy('created_at', 'desc')->first();
    }

    public function getIsPaidForAttribute()
    {
        if (! $this->is_auction) {
            return false;
        }

        return ! is_null($this->items->first()->order_item_id);
    }

    public function getEbayPrimaryCategoryIdAttribute()
    {
        return last(explode(',', $this->ebay_categories));
    }

    public function getWinnerAttribute()
    {
        if (!$this->is_auction) {
            return false;
        }

        if (!$this->ended) {
            return null;
        }

        if (!$this->bids->isEmpty() && $this->winning_bid->bid_amount > $this->price) {
            return $this->winning_bid->user;
        }
    }

    public function watchers()
    {
        return $this
            ->belongsToMany(User::class, 'favorites', 'listing_id', 'user_id')
            ->withTimestamps();
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function getEbayOfferCategoryIdAttribute()
    {
        return last(explode(',', $this->ebay_categories));
    }
}
