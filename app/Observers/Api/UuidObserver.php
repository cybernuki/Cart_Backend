<?php

namespace App\Observers\Api;

use Faker\Provider\Uuid;

class UuidObserver
{
    public function creating($model)
    {
        $model->uuid = Uuid::uuid();
    }
}
