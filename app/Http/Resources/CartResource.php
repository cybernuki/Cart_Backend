<?php

namespace App\Http\Resources;

use App\ProductCar;
use App\Http\Resources\ProductCarResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'cartItems' => ProductCarResource::collection($this->product_cars),
            'cartId' => $this->cart_id
        ];
    }
}
