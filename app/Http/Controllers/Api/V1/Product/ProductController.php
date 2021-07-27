<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Product\StoreRequest;
use App\Http\Requests\Api\V1\Product\UpdateRequest;
use App\Http\Resources\Api\V1\Product\ProductResource;
use App\Model\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * "/api/v1/products/".
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection(Product::get());
    }

    /**
     * Store a newly created resource in storage.
     * "/api/v1/products/".
     */
    public function store(StoreRequest $request)
    {
        $product = Product::create($request->all());

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     * "/api/v1/products/{product_id}".
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     * "/api/v1/products/{product_id}".
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $product->update($request->all());

        return new ProductResource($product);
    }
}
