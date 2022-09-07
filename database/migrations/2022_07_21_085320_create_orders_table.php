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
            $table->id();
            $table->foreignId('users_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('compeny_name')->nullable();
            $table->string('country');
            $table->string('address');
            $table->string('apartment')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('postcode');
            $table->string('order_notes')->nullable();
            $table->string('coupon_code')->nullable();
            $table->unsignedInteger('coupon_value')->nullable();
            $table->unsignedInteger('order_status')->nullable();
            $table->string('payment_type');
            $table->unsignedInteger('payment_status')->nullable();
            $table->unsignedInteger('total_amount');
            $table->string('track_details')->nullable();
            $table->unsignedInteger('txn_no')->unique();
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
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
