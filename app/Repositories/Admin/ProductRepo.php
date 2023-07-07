<?php
namespace App\Repositories\Admin;

use App\Http\Traits\FileUploadTrait;
use App\Models\Padideh\Product;
use App\Models\Padideh\ProductCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProductRepo {
    use FileUploadTrait;

    public function all(){
        $products = Product::latest()->paginate(15);
        return view('Padideh.products.index')->with([
            'products' => $products,
        ]);
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view('Padideh.products.create')->with([
            'categories' => $categories
        ]);
    }

    public function store($request)
    {
        $image = null;
        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->image, Product::UPLOAD_URL, 'product_image_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'link' => $request->link,
            'description' => $request->description,
            'image' => $image,
            'is_active' => $request->input('access_status') ? true : false,
        ]);
        $product->categories()->attach(
            $request->category_id
        );

        return $product;

       
    }
    public function show($product)
    {
        return view('Padideh.products.show')->with([
            'product' => $product
        ]);
    }
    public function edit($product)
    {
        $categories = ProductCategory::all();
        return view('Padideh.products.edit')->with([
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update($request,$product){
        $image = null;
        if ($request->hasFile('image')) {
            $this->removeFile('storage', Product::SHOW_URL.$product->image);
            $image = $this->uploadFile($request->image, Product::UPLOAD_URL, 'product_image_', 'storage', ['png','jpeg', 'jpg', 'svg']);
        }

        return $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'link' => $request->link,
            'description' => $request->description,
            'image' =>  $image ?? $product->image,
            'is_active' => $request->input('access_status') ? true : false,
        ]);
       
    }


    public function destroy($product)
    {
        $this->removeFile('storage', Product::SHOW_URL.$product->image);
        return $product->delete();
       
    }

    public function getProducts($request)
    {
        return Product::query()->active()->get();
    }
}
