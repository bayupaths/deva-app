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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->unsignedBigInteger('user_id');
            $table->string('order_code')->unique();
            $table->dateTime('order_date');
            $table->unsignedDecimal('total_price', 10, 2);
            $table->longText('order_note')->nullable();
            $table->enum('order_status', ['PENDING', 'PROCESSED', 'FINISHED', 'CANCELED'])->default('PENDING');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
};
