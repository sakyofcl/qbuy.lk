<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipAddresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_addresses', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name', 25)->nullable(false);
            $table->string('street', 100)->nullable(false);
            $table->string('city', 100)->nullable(false);
            $table->string('province', 100)->nullable(false);
            $table->string('zip', 100)->nullable(false);
            $table->integer('contact')->nullable(false)->unique();
            $table->integer('uid')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ship_addresses');
    }
}
