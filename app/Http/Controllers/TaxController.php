<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Wax\Shop\Models\Tax;

class TaxController extends Controller
{
    public function index()
    {
        return view('dashboard.tax.zones.index', [
            'zones' => Tax::all(),
        ]);
    }

    public function showZone($zoneId)
    {
        $zone = Tax::find($zoneId);

        if (!$zone) {
            abort(404);
        }

        return view('dashboard.tax.zones.edit', [
            'zone' => $zone,
        ]);
    }

    public function saveZone(Request $request, $zoneId)
    {
        $zone = Tax::find($zoneId);

        if (!$zone) {
            abort(404);
        }

        $this->validate(
            $request,
            [
                'rate' => 'required|numeric|min:0|max:100',
                'tax_shipping' => 'boolean',
            ]
        );

        $zone->rate = $request->input('rate');
        $zone->tax_shipping = $request->input('tax_shipping', false);
        $zone->save();

        return redirect()
            ->back()
            ->with('success', 'Tax zone edited');
    }
}
