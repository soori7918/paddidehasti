<?php

namespace App\Http\Controllers\Padideh\Admin;

use App\Http\Controllers\Controller;
use App\Models\Padideh\Product;
use App\Repositories\Admin\ProductRepo;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $productRepo;
    public function __construct(ProductRepo $productRepo)
    {
        $this->productRepo = $productRepo;
    }
    public function index()
    {
        return $this->productRepo->all();
    }


    public function create()
    {
        return $this->productRepo->create();
    }


    public function store(Request $request)
    {
        $product = $this->productRepo->store($request);
        if($product){
            return redirect()->route('panel.products.index')->with([
                'success' => 'با موفقیت ثبت شد'
            ]);
        }
    }


    public function show(Product $product)
    {
        return $this->productRepo->show($product);
    }

    public function edit(Product $product)
    {
        return $this->productRepo->edit($product);

    }


    public function update(Request $request,Product $product)
    {
        $product = $this->productRepo->update($request,$product);
        if($product){
            return redirect()->route('panel.products.index')->with([
                'success' => 'با موفقیت ثبت شد'
            ]);
        }
    }


    public function destroy(Product $product)
    {
        $result = $this->productRepo->destroy($product);
        if($result){
            return redirect()->back()->with([
                'success' => 'با موفقیت ثبت شد'
            ]);
        }
    }
}
