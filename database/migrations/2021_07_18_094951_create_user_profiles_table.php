<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name', 25)->nullable()->default('john');
            $table->string('email')->nullable()->default('john@abc.com');
            $table->string('gender')->nullable()->default('male');
            $table->string('contact')->nullable()->default("0XXXXXXXXX");
            $table->binary('image')->nullable();
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
        Schema::dropIfExists('user_profiles');
    }
}
