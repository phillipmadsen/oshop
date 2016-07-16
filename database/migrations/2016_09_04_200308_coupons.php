<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Coupons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('uses');
            $table->decimal('discount', 5, 2);
            $table->timestamps();
        });

        Schema::table('orders', function($table)
        {
            $table->unsignedInteger('coupon_id')->nullable();

            $table->foreign('coupon_id')->references('id')->on('coupons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function($table)
        {
            $table->dropForeign('orders_coupon_id_foreign');
            $table->dropColumn('coupon_id');
        });

        Schema::drop('coupons');

    }
}
