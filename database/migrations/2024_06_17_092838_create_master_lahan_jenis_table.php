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
            $table->string('lahan_id', 30)->primary();
            $table->string('lahan_nama', 50);
            $table->string('lahan_jenis_tanah', 50);
            $table->integer('lahan_ukuran');
            $table->string('lahan_keterangan', 255);
            $table->enum('lahan_aktif', ['Aktif', 'NonAktif']);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
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
