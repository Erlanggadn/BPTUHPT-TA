<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKegiatanLahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_kegiatan_lahan', function (Blueprint $table) {
            $table->string('tanam_id', 30)->primary();
            $table->string('pegawai_id', 30);
            $table->string('rumput_id', 30);
            $table->string('lahan_id', 30);
            $table->date('tanam_tanggal');
            $table->time('tanam_jam_mulai');
            $table->time('tanam_jam_selesai');
            $table->string('tanam_kegiatan', 255);
            $table->string('tanam_status', 30);
            $table->string('tanam_foto');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('rumput_id')->references('rumput_id')->on('master_rumput')->onDelete('cascade');
            $table->foreign('lahan_id')->references('lahan_id')->on('master_lahan_jenis')->onDelete('cascade');
            $table->foreign('pegawai_id')->references('pegawai_id')->on('pegawai')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_kegiatan_lahan');
    }
}
