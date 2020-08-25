<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		try {
			return response(ProductResource::collection(Product::all(), 200));
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
			'name' => 'required',
			'sku' => 'required',
			'description' => 'required',
			'price' => 'required'
		]);
		if ($validate->fails()) {
			return response()->json([
				'status_code' => 400,
				'errors' => $validate->errors()
			], 400);
		}
		try {
			$newProduct = Product::create($validate->validate());
			return response(new ProductResource($newProduct), 200);
		} catch (QueryException $exception) {
			if ($exception->getCode() == "23000") {
				return response()->json([
					'status_code' => 400,
					'errors' => 'Duplicated entry sku'
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
	public function show(Product $product)
	{
		return response(new ProductResource($product), 200);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Product $product)
	{
		$validate = Validator::make($request->toArray(), [
			'name' => 'required',
			'description' => 'required'
		]);
		if ($validate->fails()) {
			return response()->json([
				'status_code' => 400,
				'errors' => $validate->errors()
			], 400);
		}
		try {
			$product->update($validate->validate());
			return response(new ProductResource($product), 200);
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
	public function destroy(Product $product)
	{
		try {
			foreach ($product->product_cars as $productCar) {
				$productCar->delete();
			}
			$product->delete();
		} catch (QueryException $exception) {
			return response()->json([
				'status_code' => 500,
				'errors' => 'DataBase problem'
			], 500);
		}
		return response(null, 204);
	}
}
