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
            $table->increments('kand_id');
            $table->string('kand_kode');
            $table->unsignedInteger('kand_jenis');
            $table->string('kand_keterangan');
            $table->enum('kand_aktif', ['Aktif', 'NonAktif']);
            
            $table->timestamp('created_at')->useCurrent();
            $table->string('created_id', 50);
            $table->string('created_nama', 50);
            $table->timestamp('updated_at')->useCurrent();
            $table->string('updated_id', 50);
            $table->string('updated_nama', 50);

            $table->foreign('kand_jenis')->references('kandang_id')->on('master_kandang_jenis')->onDelete('cascade');
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
