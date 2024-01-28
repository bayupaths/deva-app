<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordered_detail_specifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('spec_id');
            $table->unsignedBigInteger('order_detail_id');
            $table->timestamps();

            // Define Foreing Key
            $table->foreign('spec_id')->references('id')->on('product_specifications');
            $table->foreign('order_detail_id')->references('id')->on('order_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordered_detail_specifications');
    }
};
