<?php

namespace App\Http\Controllers;

use App\ProductCar;
use Illuminate\Http\Request;

class ProductCarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $request(ProductCar::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required',
            'cart_id' => 'required',
            'quantity' => 'required',
        ]);
        return $response(ProductCar::create($data), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCar $productCar)
    {
        return $request($productCar, 200);
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
        $data = $request->validate([
            'quantity' => 'required',
        ]);
        return $response(ProductCar::update($data), 201);
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
