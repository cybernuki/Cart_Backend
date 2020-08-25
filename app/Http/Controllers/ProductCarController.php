<?php

namespace App\Http\Controllers;

use App\ProductCar;
use App\Http\Resources\ProductCarResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class ProductCarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response(ProductCarResource::collection(ProductCar::all(), 200));
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
        $validate = Validator::make($request->toArray(), [
            'product_id' => 'required',
            'cart_id' => 'required',
            'quantity' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status_code' => 400,
                'errors' => $validate->errors()
            ], 400);
        }
        try {
            return response(new ProductCarResource(ProductCar::create($validate->validate())), 201);
        } catch (QueryException $exception) {
            if ($exception->getCode() == "23000") {
                return response()->json([
                    'status_code' => 400,
                    'errors' => 'Duplicated entry field'
                ], 400);
            } else {
                return response()->json([
                    'status_code' => 500,
                    'errors' => 'DataBase problem'
                ], 500);
            }
        }
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
        $validate = Validator::make($request->toArray(), [
            'quantity' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status_code' => 400,
                'errors' => $validate->errors()
            ], 400);
        }
        try {
            if ($productCar->quantity == 0) {
                $productCar->delete();
            } else {
                $productCar->update($validate->validate());
            }
            return response(new ProductCarResource($productCar), 201);
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
    public function destroy(ProductCar $productCar)
    {
        try {
            $productCar->delete();
            return response(null, 204);
        } catch (QueryException $exception) {
            return response()->json([
                'status_code' => 500,
                'errors' => 'DataBase problem'
            ], 500);
        }
    }
}
