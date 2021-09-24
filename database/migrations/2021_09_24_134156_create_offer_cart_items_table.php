<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateOfferCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_cart_items', function (Blueprint $table) {
            $table->integer('offer_cart_id')->autoIncrement();
            $table->integer('offer');
            $table->integer('qty');
            $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('cart_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_cart_items');
    }
}
