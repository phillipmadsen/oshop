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
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('username')->nullable();
            $table->string('display_name')->nullable();
            $table->string('slug')->nullable();

            $table->string('photo')->nullable();
            $table->string('website')->nullable();
            $table->string('company')->nullable();
            $table->string('gender')->nullable();
            $table->text('about_me')->nullable();
            $table->text('note')->nullable();
            $table->string('address');
            $table->string('country');
            $table->string('city');
            $table->string('zipcode');
            $table->string('phone');

            $table->string('skypeid')->nullable();
            $table->string('githubid')->nullable();
            $table->string('twitter_username')->nullable();
            $table->string('instagram_username')->nullable();
            $table->string('facebook_username')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('linked_in_url')->nullable();
            $table->string('google_plus_url')->nullable();

            $table->timestamp('birth_date')->nullable();
            $table->string('dob_month')->nullable();
            $table->string('dob_day')->nullable();
            $table->string('dob_year')->nullable();

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('lang', 20);
            $table->string('slug')->nullable();
            $table->engine = 'InnoDB';
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
