<?php

namespace App\Http\Resources;

use App\ProductCar;
use App\Http\Resources\ProductCartResource;
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
            'cartItems' => $this->product_cars
        ];
    }
}
