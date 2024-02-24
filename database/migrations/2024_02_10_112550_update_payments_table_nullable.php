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
        Schema::table('payments', function (Blueprint $table) {
            $table->date('payment_date')->nullable()->change();
            $table->decimal('payment_amount', 10, 2)->nullable()->change();
            $table->string('payment_method', 50)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->date('payment_date')->nullable(false)->change();
            $table->decimal('payment_amount', 10, 2)->nullable(false)->change();
            $table->string('payment_method', 50)->nullable(false)->change();
        });
    }
};
