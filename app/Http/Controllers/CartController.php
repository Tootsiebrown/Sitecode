<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Wax\Shop\Models\Order\Item;
use Wax\Shop\Repositories\OrderRepository;
use Wax\Shop\Services\ShopService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $shopService;
    protected $orderRepo;

    public function __construct(ShopService $shopService, OrderRepository $orderRepo)
    {
        $this->shopService = $shopService;
        $this->orderRepo = $orderRepo;
    }

    public function index()
    {
        // This isn't necessary but it helps for debugging the math
        $this->orderRepo
            ->getActive()
            ->calculateDiscounts();

        $this->orderRepo
            ->getActive()
            ->default_shipment
            ->combineDuplicateItems();

        return view('shop.cart.index', ['order' => $this->shopService->getActiveOrder()]);
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'quantity' => 'integer'
            ]
        );

        $this->shopService->addOrderItem(
            $request->input('product_id'),
            $request->input('quantity'),
            $request->input('options', []),
            $request->input('customizations', [])
        );

        session()->flash(
            'googleAnalyticsDataLayer',
            $this->itemAddedToCartAnalyticsData(
                $request->input('quantity'),
                $request->input('customizations', [])
            )
        );

        return redirect()
            ->back()
            ->with('success', 'Item added to cart');
    }

    private function itemAddedToCartAnalyticsData($quantity, array $customizations)
    {
        $listing = Listing::find($customizations[1]);

        return [
            'event' => 'addToCart',
            'ecommerce' => [
                'add' => [
                    'products' => [
                        [
                            'name' => $listing->title,
                            'id' => $listing->id,
                            'price' => $listing->price,
                            'category' => $listing->google_analytics_category,
                            'quantity' => $quantity,
                        ]
                    ]
                ]
            ]
        ];
    }

    private function flashItemIncreaseForGoogleAnalytics(Item $item, $quantity)
    {
        $listing = $item->listing;

        session()->flash(
            'googleAnalyticsDataLayer',
            [
                'event' => 'addToCart',
                'ecommerce' => [
                    'add' => [
                        'products' => [
                            [
                                'name' => $listing->title,
                                'id' => $listing->id,
                                'price' => $listing->price,
                                'category' => $listing->google_analytics_category,
                                'quantity' => $quantity,
                            ]
                        ]
                    ]
                ]
            ]
        );
    }

    public function destroy($itemId)
    {
        $this->flashItemDecreaseForGoogleAnalytics(
            Item::find($itemId)
        );

        $this->shopService->deleteOrderItem($itemId);


        return redirect()
            ->route('shop.cart.index')
            ->with('success', 'Item deleted from cart');
    }

    private function flashItemDecreaseForGoogleAnalytics(Item $item, $quantity = null)
    {
        $listing = $item->listing;

        session()->flash(
            'googleAnalyticsDataLayer',
            [
                'event' => 'removeFromCart',
                'ecommerce' => [
                    'remove' => [
                        'products' => [
                            [
                                'name' => $listing->title,
                                'id' => $listing->id,
                                'price' => $listing->price,
                                'category' => $listing->google_analytics_category,
                                'quantity' => $quantity ?: $item->quantity,
                            ]
                        ]
                    ]
                ]
            ]
        );
    }

    public function update(Request $request)
    {
        foreach ($request->input('item') as $itemId => $quantity) {
            $item = Item::find($itemId);

            if ($item->quantity > $quantity) {
                $this->flashItemDecreaseForGoogleAnalytics(
                    $item,
                    $item->quantity - $quantity
                );
            } elseif ($item->quantity < $quantity) {
                $this->flashItemIncreaseForGoogleAnalytics(
                    $item,
                    $quantity - $item->quantity
                );
            }

            $this->shopService->updateOrderItemQuantity($itemId, (int)$quantity);
        }

        return redirect()
            ->route('shop.cart.index')
            ->with('success', 'Updated cart quantities.');
    }
}
