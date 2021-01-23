<?php

namespace App;

use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Wax\Core\Eloquent\Models\User as UserBase;
use Wax\Core\Eloquent\Models\User\Group;
use Wax\Shop\Traits\ShopUser;

/**
 * App\User
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $email_verified
 * @property string|null $email_verification_code
 * @property bool $force_password_change
 * @property string|null $payment_profile_id
 * @property string|null $accepted_terms_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Wax\Core\Eloquent\Models\User\Address[] $addresses
 * @property-read int|null $addresses_count
 * @property-read \App\Country $country
 * @property-read \Illuminate\Database\Eloquent\Collection|Listing[] $favourite_ads
 * @property-read int|null $favourite_ads_count
 * @property-read mixed $descendant_groups
 * @property-read mixed $name
 * @property-read mixed $not_groups
 * @property-read mixed $not_privileges
 * @property-read mixed $privileges
 * @property-read mixed $superuser
 * @property-read Collection|Group[] $groups
 * @property-read int|null $groups_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|Offer[] $offers
 * @property-read int|null $offers_count
 * @property-read Collection|\App\Wax\Shop\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read Collection|\Wax\Shop\Models\User\PaymentMethod[] $paymentMethods
 * @property-read int|null $payment_methods_count
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @mixin \Eloquent
 * @property int $newsletter_subscription
 */
class User extends UserBase
{
    use ShopUser;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'newsletter_subscription',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @param int $s
     * @param string $d
     * @param string $r
     * @param bool $img
     * @param array $atts
     * @return string
     */
    public function get_gravatar($s = 40, $d = 'mm', $r = 'g', $img = false, $atts = [])
    {
        $parse_url = parse_url($this->photo);
        $email = $this->email;

        if (!empty($parse_url['scheme'])) {
            $url = $this->photo;
        } else {
            $url = 'http://www.gravatar.com/avatar/';
            $url .= md5(strtolower(trim($email)));
            $url .= "?s=$s&d=$d&r=$r";

            if (!empty($this->photo)) {
                $url = avatar_img_url($this->photo, $this->photo_storage);
            }

            if ($img) {
                $url = '<img src="' . $url . '"';
                foreach ($atts as $key => $val) {
                    $url .= ' ' . $key . '="' . $val . '"';
                }
                $url .= ' />';
            }
        }

        return $url;
    }

    public function get_address()
    {
        $address = '';

        if ($this->country) {
            $address .= $this->country->country_name . ', ';
        }
        if (!empty($this->address)) {
            $address .= $this->address;
        }
        return $address;
    }


    public function favourite_ads()
    {
        return $this->belongsToMany(Listing::class, 'favorites');
    }

    public function signed_up_datetime()
    {
        $created_date_time = false;
        if ($this->created_at) {
            $created_date_time = $this->created_at->timezone(get_option('default_timezone'))->format(
                get_option('date_format_custom') . ' ' . get_option('time_format_custom')
            );
        }
        return $created_date_time;
    }

    public function status_context()
    {
        $status = $this->active_status;

        $context = '';
        switch ($status) {
            case '0':
                $context = 'Pending';
                break;
            case '1':
                $context = 'Active';
                break;
            case '2':
                $context = 'Block';
                break;
        }
        return $context;
    }

    public function isAdmin()
    {
        return $this->hasPrivilege('Administrator');
    }

    public function getNameAttribute()
    {
        return sprintf('%s %s', $this->firstname, $this->lastname);
    }

    public function hasAcceptedOfferOn(Listing $listing)
    {
        return $this
                ->offers()
                ->where('listing_id', $listing->id)
                ->status('accepted')
                ->count() > 0;
    }

    public function getOffersFor(Listing $listing)
    {
        return $this->offers()->where('listing_id', $listing->id)->get();
    }

    /*
     * @return HasMany
     */
    /**
     * @return HasMany|Builder|Collection|Offer
     */
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function orders()
    {
        return $this->hasMany(config('wax.shop.models.order'), 'user_id');
    }
}
