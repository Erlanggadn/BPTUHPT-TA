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
            $table->string('belirum_id', 30)->primary();
            // IDENTITAS PEMBELI
            $table->string('pembeli_id', 30);
            $table->bigInteger('belirum_nohp');
            $table->string('belirum_alamat', 255);
            $table->string('belirum_surat');
            $table->date('belirum_tanggal');
            $table->string('belirum_alasan', 255);
            // KEPALA BALAI
            $table->string('belirum_status', 30);
            $table->string('belirum_keterangan', 255);

            $table->foreign('pembeli_id')->references('pembeli_id')->on('pembeli')->onDelete('cascade');
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
