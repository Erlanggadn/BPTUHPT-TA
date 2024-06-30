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
            $table->string('tanam_id')->primary();
            $table->string('tanam_detail_rumput');
            $table->string('tanam_detail_lahan');
            $table->date('tanam_tanggal');
            $table->time('tanam_jam_mulai');
            $table->time('tanam_jam_selesai');
            $table->string('tanam_kegiatan');
            $table->string('tanam_status'); 
            $table->string('tanam_foto');
            
            $table->timestamp('created_at')->useCurrent();
            $table->string('created_id', 50);
            $table->string('created_nama', 50);
            $table->timestamp('updated_at')->useCurrent();
            $table->string('updated_id', 50);
            $table->string('updated_nama', 50);

            $table->foreign('tanam_detail_rumput')->references('rumput_id')->on('master_rumput')->onDelete('cascade');
            $table->foreign('tanam_detail_lahan')->references('lahan_id')->on('master_lahan_jenis')->onDelete('cascade');
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
