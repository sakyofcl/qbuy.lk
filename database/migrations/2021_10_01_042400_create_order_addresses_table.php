<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->integer('order_addr_id')->autoIncrement();
            $table->string('name', 25)->nullable(true);
            $table->string('street', 100)->nullable(true);
            $table->string('city', 100)->nullable(true);
            $table->string('province', 100)->nullable(true);
            $table->string('zip', 100)->nullable(true);
            $table->integer('contact')->nullable(true);
            $table->integer('oid')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_addresses');
    }
}
