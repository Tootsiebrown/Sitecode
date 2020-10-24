<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Wax\Core\Eloquent\Models\User\Address;

class ShippingAddressesController extends Controller
{
    public function index()
    {
        return view(
            'dashboard.shipping-addresses.index',
            [
                'addresses' => Address::where('user_id', Auth::user()->id)->paginate(20)
            ],
        );
    }

    public function show($id)
    {
        $address = Address::where('user_id', Auth::user()->id)
            ->where('id', $id)
            ->firstOrFail();

        return view(
            'dashboard.shipping-addresses.show',
            [
                'address' => $address,
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $address = Address::where('user_id', Auth::user()->id)
            ->where('id', $id)
            ->firstOrFail();

        $this->validate(
            $request,
            [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address1' => 'required',
                'city' => 'required',
                'state' => 'required|exists:tax,zone',
                'zip' => 'required',
                'default_shipping' => 'boolean',
            ],
            [
                'firstname.required' => ':attribute is required.',
                'lastname.required' => ':attribute is required.',
                'email.required' => ':attribute is required.',
                'phone.required' => ':attribute is required.',
                'address1.required' => ':attribute is required.',
                'city.required' => ':attribute is required.',
                'state.required' => ':attribute is required.',
                'state.exists' => 'State must be a valid uppercase, two-letter abbreviation.',
                'zip.required' => ':attribute is required.',
            ],
            [
                'firstname' => 'first name',
                'lastname' => 'last name',
                'address1' => 'address line 1',
            ],
        );

        $address->firstname = $request->input('firstname');
        $address->lastname = $request->input('lastname');
        $address->email = $request->input('email');
        $address->phone = $request->input('phone');
        $address->address1 = $request->input('address1');
        $address->address2 = $request->input('address2');
        $address->city = $request->input('city');
        $address->state = $request->input('state');
        $address->zip = $request->input('zip');
        $address->country = 'US';
        $address->default_shipping = $request->input('default_shipping', false);

        if ($address->default_shipping) {
            Address::where('user_id', Auth::user()->id)
                ->update(['default_shipping' => false]);
        }

        $address->save();


        return redirect()
            ->back()
            ->with('success', 'Address Updated.');
    }

    public function destroy($id)
    {
        $address = Address::where('user_id', Auth::user()->id)
            ->where('id', $id)
            ->firstOrFail();

        $address->delete();

        return redirect()
            ->route('dashboard.shippingAddresses.index')
            ->with('success', 'Address Deleted');
    }
}
