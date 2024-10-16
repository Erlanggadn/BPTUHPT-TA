<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKandangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_kandang', function (Blueprint $table) {
            $table->string('kand_id', 30)->primary();
            $table->string('kandang_id', 30);
            $table->string('kand_nama', 50);
            $table->string('kand_keterangan', 255);
            $table->enum('kand_aktif', ['Aktif', 'NonAktif']);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('kandang_id')->references('kandang_id')->on('master_kandang_jenis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_kandang');
    }
}
