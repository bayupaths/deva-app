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
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('invoice_id');
            $table->date('payment_date');
            $table->decimal('payment_amount', 10, 2);
            $table->string('payment_method', 50); // Contoh: 'Credit Card', 'Bank Transfer', dll
            $table->string('transaction_reference', 255)->nullable(); // Nomor referensi transfer atau transaksi
            $table->timestamps();

            // Define foreign key
            $table->foreign('invoice_id')->references('id')->on('invoices');
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
