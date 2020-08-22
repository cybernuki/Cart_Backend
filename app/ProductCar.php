<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCar extends Model
{
    protected $table = 'product_cars';
    protected $fillable = [
        'product_id',
        'cart_id',
        'quantity'
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function cart(){
        return $this->belongsTo(Cart::class);
    }
}
