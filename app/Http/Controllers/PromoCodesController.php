<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wax\Shop\Models\Coupon;

class PromoCodesController extends Controller
{
    public function index()
    {
        return view('dashboard.promo-codes.index', ['coupons' => Coupon::withoutGlobalScopes()->paginate(20)]);
    }

    public function create()
    {
        $coupon = new Coupon();

        return view('dashboard.promo-codes.details', [
            'coupon' => $coupon,
            'which' => null,
            'method' => 'POST',
            'action' => route('dashboard.promoCodes.store'),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required|unique:coupons',
                'code' => 'required|unique:coupons',
                'type' => 'required|in:dollars,percent',
                'dollars' => 'required_if:type,dollars|numeric',
                'percent' => 'required_if:type,percent|numeric|max:100',
                'minimum_order' => 'numeric|min:1',
                'include_shipping' => 'boolean',
                'usage_restrictions' => 'required|in:one_time,once_per_user,reusable',
                'expired_at' => 'date:Y-m-d',
                'permitted_uses' => 'numeric',
                'category_id' => 'exists:product_categories,id',
                'listing_id' => 'exists:listings,id',
            ]
        );

        $couponData = [
            'title' => $request->input('title'),
            'code' => $request->input('code'),
            'one_time' => $request->input('usage_restrictions') === 'one_time',
            'reusable' => $request->input('usage_restrictions') === 'reusable',
            'expired_at' => !empty($request->input('expired_at'))
                ? $request->input('expired_at') . ' 23:59:59'
                : null,
            'permitted_uses' => $request->input('permitted_uses'),
            'include_shipping' => $request->input('include_shipping', false),
            'dollars' => $request->input('type') === 'dollars' ? $request->input('dollars') : null,
            'percent' => $request->input('type') === 'percent' ? $request->input('percent') : null,
            'minimum_order' => $request->input('minimum_order') ?: null,
            'category_id' => $request->input('which') === 'category' ? $request->input('category_id') : null,
            'listing_id' => $request->input('which') === 'listing' ? $request->input('listing_id') : null
        ];

        if (empty($couponData['permitted_uses'])) {
            $couponData['permitted_uses'] = null;
        }

        $coupon = new Coupon($couponData);

        $coupon->save();

        return redirect()
            ->route('dashboard.promoCodes.edit', ['id' => $coupon->id])
            ->with('success', 'Promo Code created.');
    }

    public function edit($id)
    {
        $coupon = Coupon::withoutGlobalScopes()->findOrFail($id);

        $which = null;
        if ($coupon->category_id) {
            $which = 'category';
        }
        if ($coupon->listing_id) {
            $which = 'listing';
        }

        return view('dashboard.promo-codes.details', [
            'coupon' => $coupon,
            'which' => $which,
            'method' => 'PUT',
            'action' => route('dashboard.promoCodes.update', ['id' => $id]),
        ]);
    }

    public function update($id, Request $request)
    {
        $coupon = Coupon::withoutGlobalScopes()->findOrFail($id);

        $this->validate(
            $request,
            [
                'title' => 'required|unique:coupons,id,' . $id,
                'code' => 'required|unique:coupons,id,' . $id,
                'type' => 'required|in:dollars,percent',
                'dollars' => 'required_if:type,dollars|numeric',
                'percent' => 'required_if:type,percent|numeric|max:100',
                'minimum_order' => 'numeric|min:1',
                'include_shipping' => 'boolean',
                'usage_restrictions' => 'required|in:one_time,once_per_user,reusable',
                'expired_at' => 'date:Y-m-d',
                'permitted_uses' => 'numeric',
                'category_id' => 'exists:product_categories,id',
                'listing_id' => 'exists:listings,id',
            ]
        );

        $data = $request->only(['title', 'code', 'expired_at', 'minimum_order', 'include_shipping', 'permitted_uses']);
        if ($request->input('type') == 'dollars') {
            $data['dollars'] = $request->input('dollars');
            $data['percent'] = null;
        } else {
            $data['percent'] = $request->input('percent');
            $data['dollars'] = null;
        }

        $data['one_time'] = $request->input('usage_restrictions') === 'one_time';
        $data['reusable'] = $request->input('usage_restrictions') === 'reusable';

        if (!isset($data['include_shipping'])) {
            $data['include_shipping'] = false;
        }

        if (empty($data['expired_at'])) {
            unset($data['expired_at']);
        } else {
            $data['expired_at'] = $data['expired_at'] . ' 23:59:59';
        }

        if (empty($data['minimum_order'])) {
            $data['minimum_order'] = null;
        }

        if (empty($data['permitted_uses'])) {
            $data['permitted_uses'] = null;
        }

        switch ($request->input('which')) {
            case 'category':
                $data['category_id'] = $request->input('category_id');
                $data['listing_id'] = null;
                break;
            case 'listing':
                $data['category_id'] = null;
                $data['listing_id'] = $request->input('listing_id');
                break;
            default:
                $data['category_id'] = null;
                $data['listing_id'] = null;
        }

        $coupon->fill($data);
        $coupon->save();

        return redirect()
            ->back()
            ->with('success', 'Edited Promo Code');
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);

        $success = $coupon->delete();

        return redirect()
            ->route('dashboard.promoCodes.index')
            ->with(
                $success ? 'success' : 'error',
                $success ? 'Deleted coupon.' : 'Failure deleting coupon.'
            );
    }
}
