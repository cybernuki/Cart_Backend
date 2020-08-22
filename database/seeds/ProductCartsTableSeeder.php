<?php

use Illuminate\Database\Seeder;

class ProductCartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ProductCar::class,10)->create();
    }
}
