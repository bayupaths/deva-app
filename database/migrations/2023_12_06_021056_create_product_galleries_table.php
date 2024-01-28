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
    Schema::create('product_galleries', function (Blueprint $table) {
        $table->id();
        $table->uuid('uuid')->unique();
        $table->unsignedBigInteger('product_id');
        $table->string('file_name');
        $table->char('file_type', 20);
        $table->float('file_size');
        $table->string('file_path');
        $table->longText('description')->nullable();
        $table->softDeletes();
        $table->timestamps();

        // Define foreign key
        $table->foreign('product_id')->references('id')->on('products');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_galleries');
    }
};
