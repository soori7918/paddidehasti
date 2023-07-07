<?php

namespace App\Http\Controllers\Padideh\Admin;

use App\Http\Controllers\Controller;
use App\Models\Padideh\ProductCategory;
use App\Repositories\Admin\ProductCategoryRepo;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public $productCategoryRepo;
    public function __construct(ProductCategoryRepo $productCategoryRepo)
    {
        $this->productCategoryRepo = $productCategoryRepo;
    }
    public function index()
    {
        return  $this->productCategoryRepo->all();

    }


    public function create()
    {
        return $this->productCategoryRepo->create();
    }

    public function store(Request $request)
    {
        $category = $this->productCategoryRepo->store($request);
        if($category){
            return redirect()->route('panel.product_categories.index')->with([
                'success' => 'با موفقیت ثبت شد'
            ]);
        }
    }

    public function destroy(ProductCategory $product_category)
    {
        $result = $this->productCategoryRepo->destroy($product_category);
        if($result){
            return back()->with([
                'success' => 'با موفقیت حذف شذ',
            ]);
        }
    }
}
