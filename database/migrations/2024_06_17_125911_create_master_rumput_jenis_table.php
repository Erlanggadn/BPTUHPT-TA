<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterRumputJenisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_rumput_jenis', function (Blueprint $table) {
            $table->string('rum_id', 30)->primary();
            // $table->string('rum_kode', 50);
            $table->string('rum_nama', 50);
            $table->string('rum_keterangan', 255);
            // $table->enum('rum_aktif', ['Aktif', 'NonAktif']);

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
        Schema::dropIfExists('master_rumput_jenis');
    }
}
