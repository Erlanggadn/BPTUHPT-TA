<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterPembayaranRumputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_pembayaran_rumput', function (Blueprint $table) {
            $table->string('bayarrum_id', 30)->primary();
            $table->string('bayarrum_beli', 30);
            $table->string('bayarrum_invoice',);
            $table->string('bayarrum_bukti');
            $table->string('bayarrum_sudah', 30);
            $table->string('bayarrum_status', 30);
            $table->string('bayarrum_keterangan', 255);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('bayarrum_beli')->references('belirum_id')->on('master_pengajuan_rumput')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_pembayaran_rumput');
    }
}
