<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'sku',
        'description',
        'price'
    ];
    public function product_cars()
    {
        return $this->hasMany(ProductCar::class);
    }
}
