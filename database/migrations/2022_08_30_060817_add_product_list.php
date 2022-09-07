<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_lists', function (Blueprint $table) {
            $table->enum('sample_product',['No', 'Yes'])->default('No');
            $table->unsignedBigInteger('pro_shipping_charge')->nullable();
            $table->text('pro_meta_title')->nullable();
            $table->text('pro_meta_keyword')->nullable();
            $table->text('pro_meta_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_lists', function (Blueprint $table) {
            //
        });
    }
}
