<?php

use App\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('sku')->unique()->nullable(false);
            $table->longText('description')->nullable(false);
            $table->float('price');
            $table->string('image_url')->nullable(false);
            $table->enum('status', Product::getStatus())->nullable(false)->default(Product::STATUS_DISABLED);
            $table->uuid('uuid')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
