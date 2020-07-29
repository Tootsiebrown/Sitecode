<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

if (App::environment() == 'dev') {
    Route::get(
        '/frontend-test',
        function () {
            return view('site.pages.test');
        }
    );
}

Route::get(
    '/site-information',
    function () {
        return view('site.pages.site-info');
    }
);

/**
 * @project: LaraBid
 * @website: https://themeqx.com
 */

Auth::routes();

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('LanguageSwitch/{lang}', ['as' => 'switch_language', 'uses' => 'HomeController@switchLang']);

//Account activating
Route::get(
    'account/activating/{activation_code}',
    ['as' => 'email_activation_link', 'uses' => 'UserController@activatingAccount']
);

Route::get('category/{cat_id?}', ['uses' => 'CategoriesController@show'])->name('category');
Route::get('countries/{country_code?}', ['uses' => 'LocationController@countriesListsPublic'])->name('countries');
Route::get('set-country/{country_code}', ['uses' => 'LocationController@setCurrentCountry'])->name('set_country');

Route::get('searchCityJson', ['uses' => 'LocationController@searchCityJson'])->name('searchCityJson');


Route::get(
    'search/{country_code?}/{state_id?}/{city_id?}/{category_slug?}/{brand_slug?}',
    ['as' => 'search', 'uses' => 'AdsController@search']
);
Route::get('search-redirect', ['as' => 'search_redirect', 'uses' => 'AdsController@searchRedirect']);

Route::get('auctions-by-user/{id?}', ['as' => 'ads_by_user', 'uses' => 'AdsController@adsByUser']);

Route::get('auction/{id}/{slug?}', ['as' => 'single_ad', 'uses' => 'AdsController@singleAuction']);
Route::get('embedded/{slug}', ['as' => 'embedded_ad', 'uses' => 'AdsController@embeddedAd']);

Route::post('save-ad-as-favorite', ['as' => 'save_ad_as_favorite', 'uses' => 'UserController@saveAdAsFavorite']);

Route::post('reply-by-email', ['as' => 'reply_by_email_post', 'uses' => 'UserController@replyByEmailPost']);
Route::post('post-comments/{id}', ['as' => 'post_comments', 'uses' => 'CommentController@postComments']);


// Password reset routes...
Route::post('send-password-reset-link', ['as' => 'send_reset_link', 'uses' => 'Auth\PasswordController@postEmail']);

//Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
//Route::post('password/reset', ['as'=>'password_reset_post', 'uses'=>'Auth\PasswordController@postReset']);

Route::post(
    'get-sub-category-by-category',
    ['as' => 'get_sub_category_by_category', 'uses' => 'AdsController@getSubCategoryByCategory']
);
Route::post('get-brand-by-category', ['as' => 'get_brand_by_category', 'uses' => 'AdsController@getBrandByCategory']);
Route::post('get-category-info', ['as' => 'get_category_info', 'uses' => 'AdsController@getParentCategoryInfo']);
Route::post('get-state-by-country', ['as' => 'get_state_by_country', 'uses' => 'AdsController@getStateByCountry']);
Route::post('get-city-by-state', ['as' => 'get_city_by_state', 'uses' => 'AdsController@getCityByState']);
Route::post('switch/product-view', ['as' => 'switch_grid_list_view', 'uses' => 'AdsController@switchGridListView']);


Route::get('post-new', ['as' => 'create_ad', 'uses' => 'AdsController@create']);
Route::post('post-new', ['uses' => 'AdsController@store']);

//Post bid
Route::post('{id}/post-new', ['as' => 'post_bid', 'uses' => 'BidController@postBid']);


//Checkout payment
Route::get('checkout/{transaction_id}', ['as' => 'payment_checkout', 'uses' => 'PaymentController@checkout']);
Route::post('checkout/{transaction_id}', ['uses' => 'PaymentController@chargePayment']);
//Payment success url
Route::any(
    'checkout/{transaction_id}/payment-success',
    ['as' => 'payment_success_url', 'uses' => 'PaymentController@paymentSuccess']
);
Route::any(
    'checkout/{transaction_id}/paypal-notify',
    ['as' => 'paypal_notify_url', 'uses' => 'PaymentController@paypalNotify']
);


Route::group(
    ['prefix' => 'login'],
    function () {
        //Social login route

        Route::get('facebook', ['as' => 'facebook_redirect', 'uses' => 'SocialLogin@redirectFacebook']);
        Route::get('facebook-callback', ['as' => 'facebook_callback', 'uses' => 'SocialLogin@callbackFacebook']);

        Route::get('google', ['as' => 'google_redirect', 'uses' => 'SocialLogin@redirectGoogle']);
        Route::get('google-callback', ['as' => 'google_callback', 'uses' => 'SocialLogin@callbackGoogle']);

        Route::get('twitter', ['as' => 'twitter_redirect', 'uses' => 'SocialLogin@redirectTwitter']);
        Route::get('twitter-callback', ['as' => 'twitter_callback', 'uses' => 'SocialLogin@callbackTwitter']);
    }
);

Route::resource('user', 'UserController');

//Dashboard Route
Route::group(
    ['prefix' => 'dashboard', 'middleware' => 'dashboard'],
    function () {
        Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@dashboard']);

        Route::group(
            ['prefix' => 'l', 'middleware' => 'only_lister_access'],
            function () {
                Route::get('/', ['as' => 'lister.index', 'uses' => 'ListerController@index']);
                Route::post('/', ['as' => 'lister.search', 'uses' => 'ListerController@productSearch']);
                Route::get('/listing-new/{product}', ['as' => 'lister.newListing', 'uses' => 'ListerController@newListing']);
                Route::post('/listing-new', ['as' => 'lister.saveListing', 'uses' => 'ListerController@saveListing']);
            }
        );

        Route::group(
            ['prefix' => 'product-profiler'],
            function() {
                Route::get('/', ['as' => 'profiler.index', 'uses' => 'ProfilerController@index']);
                Route::post('/', ['as' => 'profiler.search', 'uses' => 'ProfilerController@profileSearch']);
                Route::get('/product-new', ['as' => 'profiler.newProduct', 'uses' => 'ProfilerController@newProduct']);
                Route::post('/product-new', ['as' => 'profiler.saveProduct', 'uses' => 'ProfilerController@saveProduct']);
            }
        );

        Route::group(
            ['middleware' => 'only_admin_access'],
            function () {
                Route::group(
                    ['prefix' => 'settings'],
                    function () {
                        Route::get(
                            'modern-theme-settings',
                            ['as' => 'modern_theme_settings', 'uses' => 'SettingsController@modernThemeSettings']
                        );
                        Route::get(
                            'social-url-settings',
                            ['as' => 'social_url_settings', 'uses' => 'SettingsController@SocialUrlSettings']
                        );
                        Route::get(
                            'general',
                            ['as' => 'general_settings', 'uses' => 'SettingsController@GeneralSettings']
                        );
                        Route::get(
                            'payments',
                            ['as' => 'payment_settings', 'uses' => 'SettingsController@PaymentSettings']
                        );
                        Route::get('ad', ['as' => 'ad_settings', 'uses' => 'SettingsController@AdSettings']);
                        Route::get('languages', ['as' => 'language_settings', 'uses' => 'LanguageController@index']);
                        Route::post('languages', ['uses' => 'LanguageController@store']);
                        Route::post(
                            'languages-delete',
                            ['as' => 'delete_language', 'uses' => 'LanguageController@destroy']
                        );

                        Route::get(
                            'storage',
                            ['as' => 'file_storage_settings', 'uses' => 'SettingsController@StorageSettings']
                        );
                        Route::get(
                            'social',
                            ['as' => 'social_settings', 'uses' => 'SettingsController@SocialSettings']
                        );
                        Route::get('other', ['as' => 'other_settings', 'uses' => 'SettingsController@OtherSettings']);
                        Route::post(
                            'other',
                            ['as' => 'other_settings', 'uses' => 'SettingsController@OtherSettingsPost']
                        );

                        Route::get(
                            'recaptcha',
                            ['as' => 're_captcha_settings', 'uses' => 'SettingsController@reCaptchaSettings']
                        );

                        //Save settings / options
                        Route::post('save-settings', ['as' => 'save_settings', 'uses' => 'SettingsController@update']);
                    }
                );

                Route::group(
                    ['prefix' => 'location'],
                    function () {
                        Route::get('country', ['as' => 'country_list', 'uses' => 'LocationController@countries']);

                        Route::get('states', ['as' => 'state_list', 'uses' => 'LocationController@stateList']);
                        Route::post('states', ['uses' => 'LocationController@saveState']);
                        Route::get(
                            'states/{id}/edit',
                            ['as' => 'edit_state', 'uses' => 'LocationController@stateEdit']
                        );
                        Route::post('states/{id}/edit', ['uses' => 'LocationController@stateEditPost']);
                        Route::post(
                            'states/delete',
                            ['as' => 'delete_state', 'uses' => 'LocationController@stateDestroy']
                        );
                        Route::get('cities', ['as' => 'city_list', 'uses' => 'LocationController@cityList']);
                        Route::post('cities', ['uses' => 'LocationController@saveCity']);

                        Route::get('cities/{id}/edit', ['as' => 'edit_city', 'uses' => 'LocationController@cityEdit']);
                        Route::post('cities/{id}/edit', ['uses' => 'LocationController@cityEditPost']);
                        Route::post('city/delete', ['as' => 'delete_city', 'uses' => 'LocationController@cityDestroy']);
                    }
                );

                Route::group(
                    ['prefix' => 'categories'],
                    function () {
                        Route::get('/', ['as' => 'parent_categories', 'uses' => 'CategoriesController@index']);
                        Route::post('/', ['uses' => 'CategoriesController@store']);

                        Route::get('edit/{id}', ['as' => 'edit_categories', 'uses' => 'CategoriesController@edit']);
                        Route::post('edit/{id}', ['uses' => 'CategoriesController@update']);

                        Route::post(
                            'delete-categories',
                            ['as' => 'delete_categories', 'uses' => 'CategoriesController@destroy']
                        );
                    }
                );

                Route::group(
                    ['prefix' => 'admin_comments'],
                    function () {
                        Route::get('/', ['as' => 'admin_comments', 'uses' => 'CommentController@index']);
                        Route::post('action', ['as' => 'comment_action', 'uses' => 'CommentController@commentAction']);
                    }
                );

                Route::get('approved', ['as' => 'approved_ads', 'uses' => 'AdsController@index']);
                Route::get('pending', ['as' => 'admin_pending_ads', 'uses' => 'AdsController@adminPendingAds']);
                Route::post('status-change', ['as' => 'ads_status_change', 'uses' => 'AdsController@adStatusChange']);

                Route::get('users', ['as' => 'users', 'uses' => 'UserController@index']);
                Route::get('users-info/{id}', ['as' => 'user_info', 'uses' => 'UserController@userInfo']);
                Route::post(
                    'change-user-status',
                    ['as' => 'change_user_status', 'uses' => 'UserController@changeStatus']
                );
                Route::post(
                    'change-user-feature',
                    ['as' => 'change_user_feature', 'uses' => 'UserController@changeFeature']
                );
                Route::get(
                    'contact-messages',
                    ['as' => 'contact_messages', 'uses' => 'HomeController@contactMessages']
                );

                Route::group(
                    ['prefix' => 'administrators'],
                    function () {
                        Route::get('/', ['as' => 'administrators', 'uses' => 'UserController@administrators']);
                        Route::get(
                            'create',
                            ['as' => 'add_administrator', 'uses' => 'UserController@addAdministrator']
                        );
                        Route::post('create', ['uses' => 'UserController@storeAdministrator']);

                        Route::post(
                            'block-unblock',
                            [
                                'as' => 'administratorBlockUnblock',
                                'uses' => 'UserController@administratorBlockUnblock',
                            ]
                        );
                    }
                );
            }
        );

        //All user can access this route
        Route::get('payments', ['as' => 'payments', 'uses' => 'PaymentController@index']);
        Route::get('payments-info/{trand_id}', ['as' => 'payment_info', 'uses' => 'PaymentController@paymentInfo']);
        //End all users access


        Route::group(
            ['prefix' => 'u'],
            function () {
                Route::group(
                    ['prefix' => 'posts'],
                    function () {
                        Route::get('/', ['as' => 'my_ads', 'uses' => 'AdsController@myAds']);
                        Route::post('delete', ['as' => 'delete_ads', 'uses' => 'AdsController@destroy']);
                        Route::get('edit/{id}', ['as' => 'edit_ad', 'uses' => 'AdsController@edit']);
                        Route::post('edit/{id}', ['uses' => 'AdsController@update']);
                        Route::get('favorite-lists', ['as' => 'favorite_ads', 'uses' => 'AdsController@favoriteAds']);
                        //Upload ads image
                        Route::post(
                            'upload-a-image',
                            ['as' => 'upload_ads_image', 'uses' => 'AdsController@uploadAdsImage']
                        );

                        //Delete media
                        Route::post('delete-media', ['as' => 'delete_media', 'uses' => 'AdsController@deleteMedia']);
                        Route::post(
                            'feature-media-creating',
                            [
                                'as' => 'feature_media_creating_ads',
                                'uses' => 'AdsController@featureMediaCreatingAds',
                            ]
                        );
                        Route::get(
                            'append-media-image',
                            ['as' => 'append_media_image', 'uses' => 'AdsController@appendMediaImage']
                        );
                        Route::get('archive-lists', ['as' => 'favourite_ad', 'uses' => 'AdsController@create']);

                        Route::get('profile', ['as' => 'profile', 'uses' => 'UserController@profile']);
                        Route::get('profile/edit', ['as' => 'profile_edit', 'uses' => 'UserController@profileEdit']);
                        Route::post('profile/edit', ['uses' => 'UserController@profileEditPost']);
                        Route::get(
                            'profile/change-avatar',
                            ['as' => 'change_avatar', 'uses' => 'UserController@changeAvatar']
                        );
                        Route::post(
                            'upload-avatar',
                            ['as' => 'upload_avatar', 'uses' => 'UserController@uploadAvatar']
                        );

                        //bids
                        Route::get('bids/{ad_id}', ['as' => 'auction_bids', 'uses' => 'BidController@index']);
                        Route::post('bids/action', ['as' => 'bid_action', 'uses' => 'BidController@bidAction']);
                        Route::get(
                            'bidder_info/{bid_id}',
                            ['as' => 'bidder_info', 'uses' => 'BidController@bidderInfo']
                        );

                        /**
                         * Change Password route
                         */
                        Route::group(
                            ['prefix' => 'account'],
                            function () {
                                Route::get(
                                    'change-password',
                                    ['as' => 'change_password', 'uses' => 'UserController@changePassword']
                                );
                                Route::post('change-password', 'UserController@changePasswordPost');
                            }
                        );
                    }
                );
            }
        );
        //Route::get('logout', ['as'=>'logout', 'uses' => 'DashboardController@logout']);
    }
);
