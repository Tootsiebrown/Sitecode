<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Listing;
use App\Models\Listing\Item;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Brand::orderBy('name');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->paginate(20);
        }

        return view('dashboard.brands.index', [
            'brands' => $query->paginate(20)
        ]);
    }

    public function show($id)
    {
        $brand = Brand::with('listings', 'products')
            ->findOrFail($id);

        $allBrands = Brand::where('id', '!=', $id)
            ->orderBy('name')
            ->get();

        return view('dashboard.brands.details', [
            'brand' => $brand,
            'allBrands' => $allBrands,
        ]);
    }

    public function save(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $brand->name = request('name');
        $brand->save();

        return redirect()
            ->back()
            ->with('success', 'Saved Brand');
    }

    public function delete(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        if (request('delete') == 'delete_only') {
            $brand->delete();
            return redirect()
                ->route('dashboard.brands.index')
                ->with('success', 'Brand deleted');
        } elseif (request('delete') === 'delete_and_move') {
            $toBrand = Brand::find(request('move_to'));

            if (!$toBrand || $toBrand->id == $id) {
                return redirect()
                    ->back()
                    ->with('error', 'Could not move to that brand');
            }

            $brand->listings()->update([
                'brand_id' => $toBrand->id,
            ]);

            $brand->products()->update([
                'brand_id' => $toBrand->id,
            ]);

            $brand->delete();

            return redirect()
                ->route('dashboard.brands.index')
                ->with('success', 'Products/listings move, and brand deleted');
        }
    }
}
