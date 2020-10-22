<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop\Coupon;

class PromoCodesController extends Controller
{
    public function index()
    {
        return view('dashboard.promo-codes.index', ['coupons' => Coupon::paginate(20)]);
    }

    public function create()
    {
        $coupon = new Coupon();

        return view('dashboard.promo-codes.details', [
            'coupon' => $coupon,
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
                'one_time' => 'boolean',
                'expired_at' => 'date:Y-m-d',
            ]
        );

        $coupon = new Coupon([
            'title' => $request->input('title'),
            'code' => $request->input('code'),
            'one_time' => $request->input('one_time', false),
            'include_shipping' => $request->input('include_shipping', false),
            'dollars' => $request->input('type') === 'dollars' ? $request->input('dollars') : null,
            'percent' => $request->input('type') === 'percent' ? $request->input('percent') : null,
            'minimum_order' => $request->input('minimum_order') ?: 0,
        ]);

        $coupon->save();

        return redirect()
            ->route('dashboard.promoCodes.edit', ['id' => $coupon->id])
            ->with('success', 'Promo Code created.');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('dashboard.promo-codes.details', [
            'coupon' => $coupon,
            'method' => 'PUT',
            'action' => route('dashboard.promoCodes.update', ['id' => $id]),
        ]);
    }

    public function update($id, Request $request)
    {
        $coupon = Coupon::findOrFail($id);

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
                'one_time' => 'boolean',
                'expired_at' => 'date:Y-m-d',
            ]
        );

        $data = $request->only(['title', 'code', 'expired_at', 'minimum_order', 'one_time', 'include_shipping']);
        if ($request->input('type') == 'dollars') {
            $data['dollars'] = $request->input('dollars');
            $data['percent'] = null;
        } else {
            $data['percent'] = $request->input('percent');
            $data['dollars'] = null;
        }

        if (!isset($data['include_shipping'])) {
            $data['include_shipping'] = false;
        }

        if (!isset($data['one_time'])) {
            $data['one_time'] = false;
        }

        if (empty($data['expired_at'])) {
            unset($data['expired_at']);
        } else {
            $data['expired_at'] = $data['expired_at'] . ' 23:59:59';
        }
        if (empty($data['minimum_order'])) {
            unset($data['minimum_order']);
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
