<?php
namespace App\Repositories\Admin;

use App\Models\Padideh\ProductCategory;

class ProductCategoryRepo {

    public function all(){
        $product_categories= ProductCategory::latest()->paginate(15);
        return view('Padideh.product_categories.index')->with([
            'product_categories' => $product_categories,
        ]);
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view('Padideh.product_categories.create')->with([
            'categories' => $categories
        ]);
    }

    public function store($request)
    {
        return ProductCategory::create([
            'name' => $request->name,
            'parent_id' => $request->family,
        ]);
    }


    public function destroy($product_category)
    {
        return $product_category->delete();
    }


}
