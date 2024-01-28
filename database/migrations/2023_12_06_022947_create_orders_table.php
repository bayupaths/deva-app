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
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('order_code')->unique();
            $table->string('order_number')->unique();
            $table->dateTime('order_date');
            $table->unsignedDecimal('total_price', 10, 2);
            $table->longText('order_note')->nullable();
            $table->enum('order_status', ['PENDING', 'PROCESSED', 'FINISHED', 'CANCELED'])->default('PENDING');
            $table->softDeletes();
            $table->timestamps();

            // Define foreign key
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('admin_id')->references('id')->on('admins');
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
