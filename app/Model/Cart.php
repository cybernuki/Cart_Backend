<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'client_id',
    ];

    public function product_cars()
    {
        return $this->hasMany(ProductCar::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
