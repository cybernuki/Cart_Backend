<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public const STATUS_ENABLED = 'enabled';
    public const STATUS_DISABLED = 'disabled';
    protected $table = 'products';

    protected $fillable = [
        'name',
        'sku',
        'description',
        'price',
        'image_url',
        'status',
    ];

    protected $attributes = [
        'status' => self::STATUS_DISABLED,
    ];

    public function product_cars()
    {
        return $this->hasMany(ProductCar::class);
    }

    public static function getStatus()
    {
        return [
            self::STATUS_ENABLED,
            self::STATUS_DISABLED,
        ];
    }
}
