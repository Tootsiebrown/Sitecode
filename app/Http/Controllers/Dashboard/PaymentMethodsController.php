<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Wax\Shop\Models\User\PaymentMethod;
use Wax\Shop\Payment\Repositories\PaymentMethodRepository;
use Wax\Shop\Services\ShopService;

class PaymentMethodsController extends Controller
{
    protected $repo;
    protected $shopService;

    public function __construct(ShopService $shopService, PaymentMethodRepository $repo)
    {
        $this->repo = $repo;
        $this->shopService = $shopService;
    }

    /**
    * List the user's PaymentMethods.
    *
    */
    public function index()
    {
        return view(
            'dashboard.payment-methods.index',
            ['paymentMethods' => $this->repo->getAll()]
        );
    }

    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        if (Auth::user()->cant('delete', $paymentMethod)) {
            abort(403);
        }

        $this->repo->delete($paymentMethod);

        return redirect()
            ->back()
            ->with('success', 'Payment Method deleted');
    }
}
