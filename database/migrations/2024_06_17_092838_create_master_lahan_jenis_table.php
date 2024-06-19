<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterLahanJenisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_lahan_jenis', function (Blueprint $table) {
            $table->increments('lahan_id');
            $table->string('lahan_kode', 50);
            $table->string('lahan_nama', 50);
            $table->string('lahan_keterangan', 50);
            $table->enum('lahan_aktif', ['Aktif', 'NonAktif']);
            $table->timestamp('created_at')->useCurrent();
            $table->string('created_id', 50);
            $table->string('created_nama', 50);
            $table->timestamp('updated_at')->useCurrent();
            $table->string('updated_id', 50);
            $table->string('updated_nama', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_lahan_jenis');
    }
}
