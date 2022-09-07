<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeasureQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measure_quotes', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('phone');
            $table->string('f_name');
            $table->string('l_name');
            $table->string('postalcode')->nullable();
            $table->string('comments')->nullable();
            $table->string('reference')->nullable();
            $table->string('street')->nullable();
            $table->string('supplement')->nullable();
            $table->string('place')->nullable();
            $table->string('house_no')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('measure_quotes');
    }
}
