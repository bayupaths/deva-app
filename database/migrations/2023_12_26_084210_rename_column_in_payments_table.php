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
            $table->renameColumn('payement_method', 'payment_method');
            $table->renameColumn('payement_date', 'payment_date');
            $table->renameColumn('payement_amount', 'payment_amount');
            $table->renameColumn('payement_status', 'payment_status');
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
            $table->renameColumn('payment_method', 'payement_method');
            $table->renameColumn('payment_date', 'payement_date');
            $table->renameColumn('payment_amount', 'payement_amount');
            $table->renameColumn('payment_status', 'payement_status');
        });
    }
};
