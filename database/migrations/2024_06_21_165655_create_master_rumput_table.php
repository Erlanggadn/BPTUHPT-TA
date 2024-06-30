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
            $table->string('rumput_id')->primary();
            $table->string('rumput_jenis');
            $table->integer('rumput_berat_awal');
            $table->integer('rumput_berat_hasil')->default(0);
            $table->date('rumput_masuk');
            $table->string('rumput_keterangan');
            $table->string('rumput_status');

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