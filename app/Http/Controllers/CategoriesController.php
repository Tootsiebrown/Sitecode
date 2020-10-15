<?php

namespace App\Http\Controllers;

use App\Category;
use App\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * parent categories
     */
    public function index()
    {
        return view('dashboard.categories.index', [
            'title' => trans('app.categories'),
            'categories' => ProductCategory::with(['listings', 'products', 'children'])->top()->orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request)
//    {
//        $rules = [
//            'category_name' => 'required'
//        ];
//        $this->validate($request, $rules);
//        $slug = str_slug($request->category_name);
//
//        $data = [
//            'category_name' => $request->category_name,
//            'category_slug' => $slug,
//            'description'   => $request->description,
//            'category_type'   => 'auction',
//        ];
//
//        Category::create($data);
//        return back()->with('success', trans('app.category_created'));
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $category = ProductCategory::findOrFail($id);

        $breadcrumb = $category->name;
        if ($category->parent) {
            $parent = $category->parent;
            $breadcrumb = $parent->name . '>' . $breadcrumb;
            if ($parent->parent) {
                $grandparent = $parent->parent;
                $breadcrumb = $grandparent->name . '>' . $breadcrumb;
            }
        }

        if ($category->parent_id === 0) {
            $peerCategories = ProductCategory::where('parent_id', 0)
                ->where('id', '!=', $category->id)
                ->orderBy('name')
                ->get();
        } else {
            $peerCategories = $category->parent->children()->where('id', '!=', $category->id)->orderBy('name')->get();
        }

        return view('dashboard.categories.details', [
            'category' => $category,
            'children' => $category->children()->with('listings', 'products', 'children')->get(),
            'peerCategories' => $peerCategories,
            'breadcrumb' => $breadcrumb,
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required'
        ];
        $this->validate($request, $rules);

        $category = ProductCategory::find($id);

        $duplicate = ProductCategory::where('id', '!=', $id)
            ->where('parent_id', $category->parent_id)
            ->where('name', $request->input('name'))
            ->count();

        if ($duplicate > 0) {
            return back()->with('error', 'Another category of the same name exists under the same parent category. No duplicate categories allowed');
        }

        $data = [
            'name' => $request->input('name'),
            'url_slug' => Str::slug($request->input('name')),
        ];
        ProductCategory::where('id', $id)->update($data);

        return back()->with('success', trans('app.category_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);

        if ($request->input('delete') === 'delete_only') {
            $delete = ProductCategory::where('id', $id)->delete();
            if ($delete) {
                return redirect()
                    ->route('dashboard.categories.index')
                    ->with('success', trans('app.category_deleted_success'));
            }

            return redirect()
                ->back()
                ->with('error', trans('app.error_msg'));
        } else if ($request->input('delete') === 'delete_and_move') {
            DB::transaction(function () use ($category, $request) {
                $toCategory = ProductCategory::findOrFail($request->input('move_to'));

                $category
                    ->products
                    ->each(function ($product) use ($category, $toCategory) {
                        $product->categories()->detach($category->id);
                        $product->categories()->attach($toCategory->id);
                    });

                $category
                    ->listings
                    ->each(function ($listing) use ($category, $toCategory) {
                        $listing->categories()->detach($category->id);
                        $listing->categories()->attach($toCategory->id);
                    });

                $category->children()->update(['parent_id' => $toCategory->id]);

                $category->delete();
            }, 3);

            return redirect()
                ->route('dashboard.categories.index')
                ->with('success', 'Category deleted, and relations moved.');
        }

        throw new \Exception('No delete logic for input data');
    }
}
