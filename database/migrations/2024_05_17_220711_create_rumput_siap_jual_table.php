<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRumputSiapJualTable extends Migration
{
    public function up()
    {
        Schema::create('rumput_siap_jual', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('id_wastukan');
            $table->date('tanggal');
            $table->string('status');
            $table->timestamps();

            $table->foreign('id_wastukan')->references('id')->on('wastukans')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rumput_siap_jual');
    }
}
