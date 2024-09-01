<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterHargaRumputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_harga_rumput', function (Blueprint $table) {
            $table->string('hr_id', 30)->primary();
            $table->string('hr_jenis', 30);
            $table->string('hr_kelamin', 30);
            $table->string('hr_kategori', 100);
            $table->bigInteger('hr_harga');

            $table->foreign('hr_jenis')->references('sjenis_id')->on('master_sapi_jenis')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_harga_rumput');
    }
}
