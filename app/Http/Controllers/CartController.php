<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Resources\CartResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response(CartResource::collection(Cart::all(), 200));
        } catch (QueryException $exception) {
            return response()->json([
                'status_code' => 500,
                'errors' => 'DataBase problem'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            return response(new CartResource(Cart::create()), 201);
        } catch (QueryException $exception) {
            return response()->json([
                'status_code' => 500,
                'errors' => 'DataBase problem'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        try {
            return response(new CartResource($cart), 200);
        } catch (QueryException $exception) {
            return response()->json([
                'status_code' => 500,
                'errors' => 'DataBase problem'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        $validate = Validator::make($request->toArray(), [
            'status' => 'required'
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status_code' => 400,
                'errors' => $validate->errors()
            ], 400);
        }
        try {
            $cart->update($validate->validate());
            return response(new CartResource($cart), 200);
        } catch (QueryException $exception) {
            return response()->json([
                'status_code' => 500,
                'errors' => 'DataBase problem'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        try {
            foreach ($cart->product_cars as $productCar) {
                $productCar->delete();
            }
            $cart->delete();
            return response(null, 204);
        } catch (QueryException $exception) {
            return response()->json([
                'status_code' => 500,
                'errors' => 'DataBase problem'
            ], 500);
        }
    }
}
