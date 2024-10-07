<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyOnPegawaiTable extends Migration
{
    public function up()
    {
        // Menghapus foreign key yang lama
        Schema::table('pegawai', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Menambah kembali foreign key dengan opsi yang baru
        Schema::table('pegawai', function (Blueprint $table) {
            // Menggunakan onDelete('restrict') atau onDelete('set null') sesuai kebutuhan
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('restrict');
        });
    }

    public function down()
    {
        // Jika Anda ingin membalikkan perubahan, hapus foreign key dan kembalikan ke semula
        Schema::table('pegawai', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade'); // Atur sesuai kondisi sebelumnya
        });
    }
}
