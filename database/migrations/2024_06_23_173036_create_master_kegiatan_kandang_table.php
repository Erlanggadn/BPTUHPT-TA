<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKegiatanKandangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_kegiatan_kandang', function (Blueprint $table) {
            $table->string('kegiatan_id')->primary();
            $table->string('kegiatan_jenis_kandang');
            $table->string('kegiatan_orang');
            $table->date('kegiatan_tanggal');
            $table->time('kegiatan_jam_mulai');
            $table->time('kegiatan_jam_selesai');
            $table->string('kegiatan_keterangan');
            $table->string('kegiatan_status'); 
            $table->string('kegiatan_foto');
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('kegiatan_jenis_kandang')->references('kand_id')->on('master_kandang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_kegiatan_kandang');
    }
}
