<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userinfo', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->primary();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('photo');
            $table->string('address');
            $table->string('country');
            $table->string('city');
            $table->string('zipcode');
            $table->string('phone');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('userinfo');
    }
}
