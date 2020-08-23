<?php

namespace App\Http\Controllers;

use App\ProductCar;
use App\Http\Resources\ProductCarResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductCarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(ProductCarResource::collection(ProductCar::all(), 200));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->toArray(),[
            'product_id' => 'required',
            'cart_id' => 'required',
            'quantity' => 'required',
        ]);
        return response(new ProductCarResource(ProductCar::create($validate->validate())), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCar $productCar)
    {
        return response(new ProductCarResource($productCar), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCar $productCar)
    {
        $validate = Validator::make($request->toArray(),[
            'quantity' => 'required',
        ]);
        $productCar->update($validate->validate());
        return response(new ProductCarResource($productCar), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCar $productCar)
    {
        $productCar->delete();
        return response(null,204);
    }
}
