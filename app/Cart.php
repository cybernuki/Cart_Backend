<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = [
        'status'
    ];
    public function product_cars() {
        return $this->hasMany(ProductCar::class);
    }
}
