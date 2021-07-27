<?php

use App\Model\Client;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClients extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable(false);
            $table->string('name')->nullable(false);
            $table->string('last_name')->nullable(false);
            $table->string('document')->nullable(false);
            $table->enum('status', Client::getStatus())->default(Client::STATUS_PENDING);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
