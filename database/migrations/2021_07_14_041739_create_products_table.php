<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->integer('pid')->autoIncrement();
            $table->string('name')->nullable(false);
            $table->integer('price')->nullable(false)->default(0);
            $table->text('description')->default('0');
            $table->integer('stock')->default(1);
            $table->integer('sold_count')->default(0);
            $table->integer('unit_weight')->default(0);
            $table->string('unit')->default('g');
            $table->binary('image');
            $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('cid')->nullable(false);
            $table->integer('sub_id')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
