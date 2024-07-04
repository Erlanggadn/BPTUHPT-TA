<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterPengajuanSapiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_pengajuan_sapi', function (Blueprint $table) {
            $table->string('belisapi_id')->primary();
            // IDENTITAS PEMBELI
            $table->unsignedBigInteger('belisapi_orang');
            $table->bigInteger('belisapi_nohp');
            $table->string('belisapi_alamat');
            $table->string('belisapi_surat');
            $table->date('belisapi_tanggal');
            $table->string('belisapi_alasan');
            // KEPALA BALAI
            $table->string('belisapi_status');
            $table->string('belisapi_keterangan');
            // DEFAULT
            $table->timestamp('created_at')->useCurrent();
            $table->string('created_id', 50);
            $table->string('created_nama', 50);
            $table->timestamp('updated_at')->useCurrent();
            $table->string('updated_id', 50);
            $table->string('updated_nama', 50);

            $table->foreign('belisapi_orang')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_pengajuan_sapi');
    }
}
