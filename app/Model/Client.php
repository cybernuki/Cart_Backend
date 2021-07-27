<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    public const STATUS_DISABLED = 'disabled';
    public const STATUS_ENABLED = 'enabled';
    public const STATUS_PENDING = 'pending';

    protected $fillable = [
        'name',
        'last_name',
        'document',
        'status',
    ];

    protected $attributes = [
        'status' => self::STATUS_PENDING,
    ];

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public static function getStatus()
    {
        return [
            self::STATUS_DISABLED,
            self::STATUS_ENABLED,
            self::STATUS_PENDING,
        ];
    }
}
