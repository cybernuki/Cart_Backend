<?php

namespace App\Http\Resources;

use App\Http\Resources\CartResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCarResource extends JsonResource
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
            "id" => $this->id,
            "quantity" => $this->quantity,
            "product" => new ProductResource($this->product)
        ];
    }
}
