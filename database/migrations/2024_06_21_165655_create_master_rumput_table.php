<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterRumputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_rumput', function (Blueprint $table) {
            $table->increments('rumput_id');
            $table->unsignedInteger('rumput_jenis');
            $table->string('rumput_kode');
            $table->integer('rumput_berat');
            $table->date('rumput_masuk');
            $table->string('rumput_keterangan');
            $table->enum('rumput_aktif', ['Aktif', 'NonAktif']);
            
            $table->timestamp('created_at')->useCurrent();
            $table->string('created_id', 50);
            $table->string('created_nama', 50);
            $table->timestamp('updated_at')->useCurrent();
            $table->string('updated_id', 50);
            $table->string('updated_nama', 50);

            $table->foreign('rumput_jenis')->references('rum_id')->on('master_rumput_jenis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_rumput');
    }
}
