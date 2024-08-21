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
            $table->string('rumput_id', 30)->primary();
            $table->string('rumput_jenis', 50);
            $table->integer('rumput_berat_awal');
            $table->integer('rumput_berat_hasil')->default(0);
            $table->date('rumput_masuk');
            $table->string('rumput_keterangan', 255);
            $table->string('rumput_status', 30);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

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