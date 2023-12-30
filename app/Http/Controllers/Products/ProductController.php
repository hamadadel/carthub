<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductIndexResource;
use Tests\Feature\Products\ProductIndexTest;

class ProductController extends Controller
{
    public function index()
    {
        return  ProductIndexResource::collection(Product::paginate(10));
    }

    public function show(Product $product)
    {
        return new ProductIndexResource($product);
    }
}
