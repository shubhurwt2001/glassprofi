<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributeImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute_images', function (Blueprint $table) {
            $table->id();
            $table->string('attr_image_name');
            $table->integer('attr_price_from')->unsigned();
            $table->string('attr_image');
            $table->foreignId('attr_id');
            $table->enum('attr_image_status',[0, 1])->default(1);
            $table->timestamps();

            $table->foreign('attr_id')->references('id')->on('product_attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attribute_images');
    }
}
