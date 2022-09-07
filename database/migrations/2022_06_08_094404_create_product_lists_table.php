<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->unsignedInteger('value');
            $table->unsignedInteger('delivery_time');
            $table->string('slug')->unique();
            $table->string('product_route_name');
            $table->text('short_desc');
            $table->longtext('desc');
            $table->longtext('keywords');
            $table->string('pro_image');
            //$table->unsignedInteger('navbars_id');
            $table->foreignId('navbars_id');
            $table->enum('pro_status',[0, 1])->default(0);
            //$table->string('is_popular');
            //$table->string('show_on_homepage');
            $table->enum('is_popular',['Yes', 'No'])->default('No');
            $table->enum('show_on_homepage',['Yes', 'No'])->default('No');
            $table->timestamps();

            $table->foreign('navbars_id')->references('id')->on('navbars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_lists');
    }
}
