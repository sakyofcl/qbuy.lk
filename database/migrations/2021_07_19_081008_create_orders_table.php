<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('oid')->autoIncrement()->start_from(1000);
            $table->string('name')->nullable(false);
            $table->string('address')->nullable(false);
            $table->string('city')->nullable(false);
            $table->integer('phone')->nullable(false);
            $table->string('status')->nullable(false)->default('process');
            $table->string('payment')->nullable(false);
            $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('orders');
    }
}
