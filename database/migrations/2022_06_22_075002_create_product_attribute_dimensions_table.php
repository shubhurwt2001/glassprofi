<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributeDimensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute_dimensions', function (Blueprint $table) {
            $table->id();
            $table->string('dim_name');
            $table->string('dim_description');
            $table->integer('dim_start')->unsigned();
            $table->integer('dim_end')->unsigned();
            $table->foreignId('attr_image_id');
            $table->enum('attr_dim_status',[0, 1])->default(1);
            $table->timestamps();

            $table->foreign('attr_image_id')->references('id')->on('product_attribute_images')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attribute_dimensions');
    }
}
