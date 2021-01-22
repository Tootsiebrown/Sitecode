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

if (App::environment() == 'local') {
    Route::get(
        '/frontend-test',
        function () {
            return view('site.pages.test');
        }
    );
}


Route::get('exception')
    ->uses('ExceptionController@exception');

/**
 * @project: LaraBid
 * @website: https://themeqx.com
 */

Auth::routes();

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

//Account activating
Route::get(
    'account/activating/{activation_code}',
    ['as' => 'email_activation_link', 'uses' => 'UserController@activatingAccount']
);


Route::get('search')
    ->uses('AdsController@search')
    ->name('search');

Route::get('auction/{id}', ['as' => 'singleAdRedirect', 'uses' => 'AdsController@singleAuctionRedirect']);
Route::get('auction/{id}/{slug}', ['as' => 'singleListing', 'uses' => 'AdsController@singleAuction']);
Route::get('embedded/{slug}', ['as' => 'embedded_ad', 'uses' => 'AdsController@embeddedAd']);

Route::middleware('auth')
    ->group(function () {
        Route::post('watch-listing')
            ->uses('UserController@watchListing')
            ->name('watchListing');

        Route::post('make-an-offer')
            ->uses('OfferController@make')
            ->name('makeAnOffer');

        Route::post('{id}/post-new')
            ->uses('BidController@postBid')
            ->name('post_bid');

        Route::get('pay-for-auction')
            ->uses('PayForItController@endedAuction')
            ->middleware('auth')
            ->name('payForEndedAuction');

        Route::get('pay-for-accepted-offer')
            ->middleware('auth')
            ->name('payForAcceptedOffer')
            ->uses('PayForItController@acceptedOffer');
    });

Route::post(
    'get-sub-category-by-category',
    ['as' => 'get_sub_category_by_category', 'uses' => 'AdsController@getSubCategoryByCategory']
);
Route::post('get-brand-by-category', ['as' => 'get_brand_by_category', 'uses' => 'AdsController@getBrandByCategory']);
Route::post('get-category-info', ['as' => 'get_category_info', 'uses' => 'AdsController@getParentCategoryInfo']);
Route::post('get-state-by-country', ['as' => 'get_state_by_country', 'uses' => 'AdsController@getStateByCountry']);
Route::post('get-city-by-state', ['as' => 'get_city_by_state', 'uses' => 'AdsController@getCityByState']);
Route::post('switch/product-view', ['as' => 'switch_grid_list_view', 'uses' => 'AdsController@switchGridListView']);

Route::get('get-product-category-children', ['as' => 'getProductCategoryChildren', 'uses' => 'ListerController@getCategoryChildren']);


Route::resource('user', 'UserController');

//Dashboard Route
Route::group(
    ['prefix' => 'dashboard', 'middleware' => 'dashboard'],
    function () {
        Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@dashboard']);

        Route::post('image-upload')
            ->name('dashboard.uploadImage')
            ->uses('Dashboard\ImageUploadController@upload');

        Route::middleware('privilege:Lister')
            ->prefix('lister')
            ->name('lister.')
            ->group(function () {
                Route::get('/', ['as' => 'index', 'uses' => 'ListerController@index']);
                Route::post('/', ['as' => 'datafiniti', 'uses' => 'ListerController@index']);

                Route::get('product', ['as' => 'productForm', 'uses' => 'ListerController@productForm']);
                Route::post('product', ['as' => 'saveProduct', 'uses' => 'ListerController@saveProduct']);
                Route::get("product-clone", ['as' => 'cloneProduct', 'uses' => 'ListerController@cloneProduct']);

                Route::get('listing', ['as' => 'newListing', 'uses' => 'ListerController@newListing']);
                Route::post('listing', ['as' => 'saveListing', 'uses' => 'ListerController@saveListing']);
                Route::get('listing/{id}', ['as' => 'finished', 'uses' => 'ListerController@listingFinished']);

                Route::post('upload-image', ['as' => 'upload-image', 'uses' => 'ListerController@uploadImage']);
            });

        Route::prefix('listings')
            ->name('dashboard.listings.')
            ->middleware('privilege:Listings')
            ->group(function() {
                Route::get('/')
                    ->uses('AdsController@index')
                    ->name('index');
                Route::get('sort-featured')
                    ->uses('AdsController@showSortFeatured')
                    ->name('sort-featured');
                Route::post('sort-featured')
                    ->uses('AdsController@saveSortFeatured');
                Route::get('{id}')
                    ->uses('AdsController@showEdit')
                    ->name('showEdit');
                Route::post('{id}')
                    ->uses('AdsController@saveEdit')
                    ->name('saveEdit');
                Route::delete('{id}')
                    ->uses('AdsController@delete')
                    ->name('delete');
            });

        Route::prefix('auctions')
            ->name('dashboard.auctions.')
            ->middleware('privilege:Listings')
            ->group(function () {
                Route::get('/')
                    ->name('index')
                    ->uses('AuctionsController@index');
            });

        Route::prefix('bins')
            ->name('dashboard.bins.')
            ->middleware('privilege:Bins')
            ->group(function () {
                Route::get('/')
                    ->uses('BinsController@index')
                    ->name('index');
                Route::get('item/{id}')
                    ->uses('BinsController@showItemBin')
                    ->name('showItemBin');
                Route::post('item/{id}')
                    ->uses('BinsController@saveItemBin')
                    ->name('saveItemBin');
                Route::get('listing/{id}')
                    ->uses('BinsController@showListingBins')
                    ->name('showListingBins');
                Route::post('listing/{id}')
                    ->uses('BinsController@saveListingBins')
                    ->name('saveListingBins');
                Route::post('listing-bulk')
                    ->uses('BinsController@bulkEditListingBins')
                    ->name('bulkEditListingBins');
                Route::post('add-items')
                    ->uses('BinsController@addItems')
                    ->name('addItems');

            });

        Route::prefix('tax')
            ->middleware('privilege:Tax Table')
            ->name('dashboard.tax.')
            ->group(function () {
                Route::get('zones')
                    ->uses('TaxController@index')
                    ->name('zones.index');
                Route::get('zones/{id}')
                    ->uses('TaxController@showZone')
                    ->name('zones.show');
                Route::post('zones/{id}')
                    ->uses('TaxController@saveZone')
                    ->name('zones.save');

                Route::get('report')
                    ->uses('TaxReportController@index')
                    ->name('report.index');
                Route::get('report/{year}')
                    ->uses('TaxReportController@year')
                    ->name('report.year');
                Route::get('report/{year}/{month}')
                    ->uses('TaxReportController@month')
                    ->name('report.month');
            });

        Route::prefix('categories')
            ->middleware('privilege:Categories')
            ->name('dashboard.categories.')
            ->group(function () {
                Route::get('/')
                    ->name('index')
                    ->uses('CategoriesController@index');
                Route::get('{id}')
                    ->name('show')
                    ->uses('CategoriesController@show');
                Route::post('{id}')
                    ->name('save')
                    ->uses('CategoriesController@update');
                Route::delete('{id}')
                    ->name('delete')
                    ->uses('CategoriesController@destroy');
            });

        Route::prefix('brands')
            ->middleware('privilege:Brands')
            ->name('dashboard.brands.')
            ->group(function () {
                Route::get('/')
                    ->name('index')
                    ->uses('BrandsController@index');
                Route::get('{id}')
                    ->name('show')
                    ->uses('BrandsController@show');
                Route::post('{id}')
                    ->name('save')
                    ->uses('BrandsController@save');
                Route::delete('{id}')
                    ->name('delete')
                    ->uses('BrandsController@delete');
            });

        Route::prefix('promo-codes')
            ->middleware('privilege:Promo Codes')
            ->name('dashboard.promoCodes.')
            ->group(function () {
                Route::get('/')
                    ->name('index')
                    ->uses('PromoCodesController@index');
                Route::post('/')
                    ->name('store')
                    ->uses('PromoCodesController@store');
                Route::get('create')
                    ->name('create')
                    ->uses('PromoCodesController@create');
                Route::get('{id}/edit')
                    ->name('edit')
                    ->uses('PromoCodesController@edit');
                Route::put('{id}')
                    ->name('update')
                    ->uses('PromoCodesController@update');
                Route::delete('{id}')
                    ->name('destroy')
                    ->uses('PromoCodesController@destroy');
            });

        Route::get('auction-activity')
            ->uses('AuctionActivityController@index')
            ->name('dashboard.auction-activity');

        Route::prefix('orders')
            ->name('dashboard.orders.')
            ->group(function () {
                Route::get('/')
                    ->name('index')
                    ->uses('DashboardOrdersController@index');

                Route::get('{id}')
                    ->name('details')
                    ->uses('DashboardOrdersController@details');
            });

        Route::prefix('my-offers')
            ->name('dashboard.my-offers.')
            ->group(function () {
                Route::get('/')
                    ->uses('OfferController@customerIndex')
                    ->name('index');
                Route::get('{id}')
                    ->uses('OfferController@customerShow')
                    ->name('show');
                Route::post('{id}/accept')
                    ->uses('OfferController@customerAccept')
                    ->name('accept');
                Route::post('{id}/reject')
                    ->uses('OfferController@customerReject')
                    ->name('reject');

            });

        Route::prefix('payment-methods')
            ->name('dashboard.paymentMethods.')
            ->group(function () {
                Route::get('/')
                    ->uses('Dashboard\PaymentMethodsController@index')
                    ->name('index');
                Route::get('delete/{id}')
                    ->name('destroy')
                    ->uses('Dashboard\PaymentMethodsController@destroy');
            });

        Route::prefix('carousel')
            ->name('dashboard.carousel.')
            ->middleware('privilege:Carousel')
            ->group(function () {
                Route::get('/')
                    ->name('index')
                    ->uses('Dashboard\CarouselController@index');
                Route::get('create')
                    ->name('create')
                    ->uses('Dashboard\CarouselController@create');
                Route::post('store')
                    ->name('store')
                    ->uses('Dashboard\CarouselController@store');
                Route::get('{id}')
                    ->name('edit')
                    ->uses('Dashboard\CarouselController@edit');
                Route::patch('{id}')
                    ->name('update')
                    ->uses('Dashboard\CarouselController@update');
            });

        Route::prefix('offers')
            ->name('dashboard.offers.')
            ->middleware('privilege:Offers')
            ->group(function () {
                Route::get('/')
                    ->name('index')
                    ->uses('OfferController@index');
                Route::get('{id}')
                    ->name('show')
                    ->uses('OfferController@show');
                Route::post('{id}/accept')
                    ->name('accept')
                    ->uses('OfferController@accept');
                Route::post('{id}/reject')
                    ->name('reject')
                    ->uses('OfferController@reject');
                Route::post('{id}/counter')
                    ->name('counter')
                    ->uses('OfferController@counter');
            });

        Route::middleware('privilege:Manager')
            ->group(function () {
                Route::name('dashboard.emails.')
                    ->prefix('emails')
                    ->group(function () {
                        Route::get('/')
                            ->name('index')
                            ->uses('MailPreviewController@index');
                        Route::get('iframe/{slug}')
                            ->name('iframe')
                            ->uses('MailPreviewController@iframe');

                        Route::get('order-placed')
                            ->name('orderPlaced')
                            ->uses('MailPreviewController@orderPlaced');
                        Route::get('order-shipped')
                            ->name('orderShipped')
                            ->uses('MailPreviewController@orderShipped');
                        Route::get('auction-won')
                            ->name('auctionWon')
                            ->uses('MailPreviewController@auctionWon');
                        Route::get('auction-ended-no-winner')
                            ->name('auctionEndedNoWinner')
                            ->uses('MailPreviewController@auctionEndedNoWinner');
                        Route::get('offer-submitted')
                            ->name('offerSubmitted')
                            ->uses('MailPreviewController@offerSubmitted');
                        Route::get('offer-accepted')
                            ->name('offerAccepted')
                            ->uses('MailPreviewController@offerAccepted');
                        Route::get('offer-rejected')
                            ->name('offerRejected')
                            ->uses('MailPreviewController@offerRejected');
                        Route::get('offer-countered')
                            ->name('offerCountered')
                            ->uses('MailPreviewController@offerCountered');
                        Route::get('watcher-ended')
                            ->name('watcherEnded')
                            ->uses('MailPreviewController@notifyWatcherAuctionEnded');
                        Route::get('bid-received')
                            ->name('bidReceived')
                            ->uses('MailPreviewController@notifyWatcherBidReceived');
                        Route::get('auction-ending')
                            ->name('auctionEnding')
                            ->uses('MailPreviewController@notifyWatcherAuctionEndingSoon');
                        Route::get('offer-expired')
                            ->name('offerExpired')
                            ->uses('MailPreviewController@offerExpired');
                        Route::get('counter-offer-expired')
                            ->name('counterOfferExpired')
                            ->uses('MailPreviewController@counterOfferExpired');
                        Route::get('someone-else-bought-it')
                            ->name('someoneElseBoughtIt')
                            ->uses('MailPreviewController@someoneElseBoughtIt');
                        Route::get('auction-payment-needed')
                            ->name('auctionPaymentNeeded')
                            ->uses('MailPreviewController@auctionPaymentNeeded');
                    });

                Route::middleware('privilege:Ebay Authentication')
                    ->name('dashboard.ebayAuth.')
                    ->prefix('ebay-auth')
                    ->group(function () {
                        Route::get('status')
                            ->name('status')
                            ->uses('Dashboard\EbayOAuthController@showStatus');
                        Route::get('link')
                            ->name('link')
                            ->uses('Dashboard\EbayOAuthController@link');
                        Route::get('initiate-link')
                            ->name('initiateLink')
                            ->uses('Dashboard\EbayOAuthController@initiateLink');
                    });

                Route::middleware('privilege:Ebay Orders')
                    ->name('dashboard.ebay.orders')
                    ->prefix('ebay')
                    ->group(function () {
                        Route::get('orders')
                            ->name('')
                            ->uses('Dashboard\EbayOrdersController@index');

                        Route::get('orders/{id}')
                            ->name('.details')
                            ->uses('Dashboard\EbayOrdersController@show');

                        Route::post('orders/{id}/cancel')
                            ->name('.cancel')
                            ->uses('Dashboard\EbayOrdersController@cancel');
                    });

                Route::get('users', ['as' => 'users', 'uses' => 'UserController@index']);
                Route::get('users/{id}', ['as' => 'user_info', 'uses' => 'UserController@userInfo']);
                Route::post('users/{id}')
                    ->name('dashboard.users.update')
                    ->uses('UserController@update');
            });

        Route::name('dashboard.shop.orders.')
            ->prefix('shop/orders')
            ->middleware('privilege:Orders')
            ->group(function () {
                Route::get('/')
                    ->name('index')
                    ->uses('ShopOrdersController@index');

                Route::get('report')
                    ->name('report')
                    ->uses('ShopOrdersController@report');

                Route::get('sales-by-category')
                    ->name('salesByCategory')
                    ->uses('ShopOrdersController@salesByCategory');

                Route::get('{id}')
                    ->name('details')
                    ->uses('ShopOrdersController@details');
                Route::post('{orderId}/items/{itemId}/toggle-removed')
                    ->name('items.toggle-removed')
                    ->uses('ShopOrdersController@toggleItemRemoved');
                Route::post('{id}/status')
                    ->name('status')
                    ->uses('ShopOrdersController@setStatus');
                Route::post('{id}/cancel')
                    ->name('cancel')
                    ->uses('ShopOrdersController@cancel');
            });

        Route::name('dashboard.shippingAddresses.')
            ->prefix('shipping-addresses')
            ->group(function () {
                Route::get('/')
                    ->name('index')
                    ->uses('ShippingAddressesController@index');
                Route::get('{id}')
                    ->name('show')
                    ->uses('ShippingAddressesController@show');
                Route::put('{id}')
                    ->name('update')
                    ->uses('ShippingAddressesController@update');
                Route::delete('{id}')
                    ->name('destroy')
                    ->uses('ShippingAddressesController@destroy');
            });


        Route::group(
            ['prefix' => 'u'],
            function () {
                Route::group(
                    ['prefix' => 'posts'],
                    function () {
                        Route::get('favorite-lists', ['as' => 'favorite_ads', 'uses' => 'AdsController@favoriteAds']);
                        Route::get('profile', ['as' => 'profile', 'uses' => 'UserController@profile']);
                        Route::get('profile/edit', ['as' => 'profile_edit', 'uses' => 'UserController@profileEdit']);
                        Route::post('profile/edit', ['uses' => 'UserController@profileEditPost']);

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
    }
);

Route::name('shop.')
    ->group(function () {
        Route::name('cart.')
            ->prefix('cart')
            ->group(function () {
                Route::get('/', 'CartController@index')
                    ->name('index');
                Route::post('add')
                    ->uses('CartController@store')
                    ->name('add');
                Route::delete('{itemId}')
                    ->uses('CartController@destroy')
                    ->name('delete');
                Route::post('update')
                    ->name('update')
                    ->uses('CartController@update');
            });


        Route::prefix('checkout')
            ->name('checkout.')
            ->group(function() {
                Route::get('', '\App\Wax\Shop\Controllers\CheckoutController@checkout')
                    ->name('start');

                Route::get('shipping')
                    ->uses('\App\Wax\Shop\Controllers\ShippingController@showShipping')
                    ->name('showShipping');
                Route::post('shipping')
                    ->uses('\App\Wax\Shop\Controllers\ShippingController@saveShipping')
                    ->name('saveShipping');

                Route::get('rates')
                    ->uses('\App\Wax\Shop\Controllers\ShippingController@showRates')
                    ->name('showRates');
                Route::post('rate')
                    ->uses('\App\Wax\Shop\Controllers\ShippingController@saveRate')
                    ->name('saveRate');

                Route::get('billing', '\App\Wax\Shop\Controllers\CheckoutController@showBilling')
                    ->name('showBilling');
                Route::post('billing', '\App\Wax\Shop\Controllers\CheckoutController@pay')
                    ->name('saveBilling');

                Route::get('confirmation')
                    ->uses('\App\Wax\Shop\Controllers\CheckoutController@showConfirmation')
                    ->name('confirmation');

                Route::post('code')
                    ->uses('CheckoutPromoCodesController@store')
                    ->name('applyCode');
                Route::delete('code/{code}')
                    ->uses('CheckoutPromoCodesController@destroy')
                    ->name('removeCode');
            });
    });

Route::name('shop::')
    ->prefix('admin')
    ->middleware('auth.panel')
    ->group(function () {
        /**
         * Order Manager
         */
        Route::get('shop/order/{id}', 'Admin\OrdersController@show')
            ->name('orderDetails');
        Route::get('shop/order/{id}/print', 'Admin\OrdersController@print')
            ->name('orderDetails.print');
        Route::post('shop/order/{id}/add-tracking/{shipmentId}', 'Admin\OrdersController@addTracking')
            ->name('orderDetails.addTracking');
        Route::post('shop/order/{id}/capture-payments', 'Admin\OrdersController@capturePayments')
            ->name('orderDetails.capturePayments');
        Route::post('shop/order/{id}/mark-processed')
            ->uses('Admin\OrdersController@markProcessed')
            ->name('orderDetails.markProcessed');
    });

Route::name('webhooks.')
    ->prefix('webhooks')
    ->group(function () {
        Route::post('order-shipped')
            ->name('order-shipped')
            ->uses('WebHookController@orderShipped');
        Route::post('ebay-inventory-check')
            ->name('ebayInventoryCheck')
            ->middleware(['auth.basic', 'privilege:Ebay Inventory'])
            ->uses('WebHookController@ebayInventoryCheck');
        Route::post('ebay-notification')
            ->name('ebayNotification')
            ->uses('WebHookController@ebayNotification');
    });

