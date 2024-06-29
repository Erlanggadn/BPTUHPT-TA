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
            $table->string('rum_id')->primary();
            // $table->string('rum_kode', 50);
            $table->string('rum_nama', 50);
            $table->string('rum_keterangan', 50);
            // $table->enum('rum_aktif', ['Aktif', 'NonAktif']);

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
        Schema::dropIfExists('master_rumput_jenis');
    }
}
