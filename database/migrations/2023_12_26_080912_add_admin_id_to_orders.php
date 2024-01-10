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
        Schema::table('orders', function (Blueprint $table) {
           // Tambahkan kolom admin_id
           $table->unsignedBigInteger('admin_id')->nullable()->after('user_id');
           // Definisi relasi dengan tabel admins
           $table->foreign('admin_id')->references('admin_id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Hapus kolom admin_id dan relasinya
            $table->dropForeign(['admin_id']);
            $table->dropColumn('admin_id');
        });
    }
};
