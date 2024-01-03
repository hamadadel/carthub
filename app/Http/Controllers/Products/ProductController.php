<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductIndexResource;
use App\Http\Resources\ProductResource;
use App\Scoping\Scopes\CategoryScope;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        //     if (!$request->query())
        //         return ProductIndexResource::collection(Product::paginate(10));
        return  ProductIndexResource::collection(
            Product::withScopes($this->scopes())->paginate(10)
        );
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    private function scopes()
    {
        return [
            'category' => new CategoryScope,
        ];
    }
}
