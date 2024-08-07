<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterPengajuanRumputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_pengajuan_rumput', function (Blueprint $table) {
            $table->string('belirum_id')->primary();
            // IDENTITAS PEMBELI
            $table->string('belirum_orang');
            $table->bigInteger('belirum_nohp');
            $table->string('belirum_alamat');
            $table->string('belirum_surat');
            $table->date('belirum_tanggal');
            $table->string('belirum_alasan');
            // KEPALA BALAI
            $table->string('belirum_status');
            $table->string('belirum_keterangan');

            $table->foreign('belirum_orang')->references('pembeli_id')->on('pembeli')->onDelete('cascade');
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
        Schema::dropIfExists('master_pengajuan_rumput');
    }
}
