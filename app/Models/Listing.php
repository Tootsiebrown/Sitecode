<?php

namespace App\Models;

use App\Bid;
use App\City;
use App\Country;
use App\Favorite;
use App\HasCondition;
use App\HasProductCategories;
use App\Models\Listing\EbayAspect;
use App\Models\Listing\Image;
use App\Models\Listing\Item;
use App\State;
use App\User;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Listing
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property string|null $features
 * @property string|null $description
 * @property string|null $upc
 * @property int|null $product_id
 * @property float|null $price
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $type
 * @property int|null $brand_id
 * @property string|null $original_price
 * @property string $condition
 * @property string|null $gender
 * @property string|null $model_number
 * @property string|null $color
 * @property int $view
 * @property string|null $size
 * @property string|null $expiration_date
 * @property string|null $dimensions
 * @property Carbon|null $expired_at
 * @property int $end_event_fired
 * @property float|null $shipping_weight_oz
 * @property bool $featured
 * @property int|null $featured_sort_id
 * @property bool $offers_enabled
 * @property int $secret
 * @property int|null $send_to_ebay_markup
 * @property string|null $sent_to_ebay_at
 * @property string|null $ebay_categories
 * @property string|null $ebay_offer_id
 * @property int|null $ebay_condition_id
 * @property int $send_to_ebay
 * @property string|null $send_to_ebay_at
 * @property string|null $to_ebay_error_at
 * @property string|null $ebay_listing_id
 * @property-read Collection|Bid[] $bids
 * @property-read int|null $bids_count
 * @property-read Brand|null $brand
 * @property-read Collection|ProductCategory[] $categories
 * @property-read int|null $categories_count
 * @property-read City $city
 * @property-read Country $country
 * @property-read mixed $category
 * @property-read mixed $child_category
 * @property-read mixed $ebay_condition_enum
 * @property-read mixed $ebay_offer_category_id
 * @property-read mixed $ebay_primary_category_id
 * @property-read bool $ended
 * @property-read mixed $featured_image
 * @property-read mixed $grandchild_category
 * @property-read mixed $has_available_items
 * @property-read mixed $i_won
 * @property-read bool $is_auction
 * @property-read mixed $is_bidding_active
 * @property-read mixed $is_paid_for
 * @property-read bool $is_set_price
 * @property-read mixed $my_most_recent_bid
 * @property-read int $quantity
 * @property-read mixed $url
 * @property-read mixed $winner
 * @property-read mixed $winning_bid
 * @property-read Collection|Image[] $images
 * @property-read int|null $images_count
 * @property-read Collection|Item[] $items
 * @property-read int|null $items_count
 * @property-read Collection|Offer[] $offers
 * @property-read int|null $offers_count
 * @property-read State $state
 * @property-read User $user
 * @property-read Collection|User[] $watchers
 * @property-read int|null $watchers_count
 * @method static Builder|Listing active()
 * @method static Builder|Listing endEventNotFired()
 * @method static Builder|Listing expired()
 * @method static Builder|Listing featured()
 * @method static Builder|Listing freeOfEbayError()
 * @method static Builder|Listing inCategory($categoryId)
 * @method static Builder|Listing newModelQuery()
 * @method static Builder|Listing newQuery()
 * @method static Builder|Listing notYetSentToEbay()
 * @method static Builder|Listing ofBrand($brandId)
 * @method static Builder|Listing query()
 * @method static Builder|Listing readyForEbay()
 * @method static Builder|Listing thatIBidFor()
 * @method static Builder|Listing timePastForEbay()
 * @method static Builder|Listing typeIsAuction()
 * @method static findOrFail($listingId)
 * @mixin Eloquent
 * @property-read Collection|EbayAspect[] $ebayAspects
 * @property-read int|null $ebay_aspects_count
 */
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

    public function user(): BelongsTo
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

        return $query;
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
            ->freeOfEbayError()
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

    public function scopeFreeOfEbayError($query)
    {
        return $query->whereNull('to_ebay_error_at');
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

    /**
     * @return HasMany|Bid
     */
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

    public function premium_icon(): string
    {
        if ($this->price_plan == 'premium') {
            $html = '<img src="' . asset('assets/img/premium-icon.png') . '" alt="" />';
            return $html;
        }

        return '';
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ProductCategory::class, 'ad_category_links', 'ad_id', 'category_id');
    }

    public static function getOptionalFieldsForDisplay(): array
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

    public function hasOptionalFieldsForDisplay(): bool
    {
        foreach (static::getOptionalFieldsForDisplay() as $fieldName => $fieldLabel) {
            if (!is_null($this->$fieldName)) {
                return true;
            }
        }

        return false;
    }

    public function getUrlAttribute(): string
    {
        return route('singleListing', [
            'id' => $this->id,
            'slug' => $this->slug,
        ]);
    }

    /**
     * @return HasMany|Item
     */
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

    public function itemsForEbayOrder($ebayOrderId)
    {
        return $this->items()->forEbayOrder($ebayOrderId);
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

        return null;
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

    public function ebayAspects()
    {
        return $this->hasMany(EbayAspect::class);
    }

    public function getGoogleAnalyticsCategoryAttribute(): string
    {
        $category = $this->category->name;

        if ($this->child_category) {
            $category .= '/' . $this->child_category->name;
        }

        if ($this->grandchild_category) {
            $category .= '/' . $this->grandchild_category->name;
        }

        return $category;
    }
}
