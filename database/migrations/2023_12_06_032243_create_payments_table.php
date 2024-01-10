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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->unsignedBigInteger('order_id');
            $table->string('payment_code')->unique();
            $table->string('payement_method');
            $table->char('card_number', 20)->nullabel();
            $table->string('cardholder_name')->nullabel();
            $table->dateTime('payement_date');
            $table->unsignedDecimal('payement_amount', 10, 2);
            $table->enum('payement_status', ['UNPAID', 'PROCESSED', 'SUCCESS', 'FAILED'])->default('UNPAID');
            $table->foreign('order_id')->references('order_id')->on('orders');
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
        Schema::dropIfExists('payments');
    }
};
