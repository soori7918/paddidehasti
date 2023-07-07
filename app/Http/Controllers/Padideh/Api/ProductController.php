<?php

namespace App\Http\Controllers\Padideh\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Padideh\ProductResource;
use App\Repositories\Admin\ProductRepo;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepo $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    public function productList(Request $request){
        $products = ProductResource::collection($this->productRepository->getProducts($request));
        return $this->successResponse('لیست محصولات', $products);
    }
}
