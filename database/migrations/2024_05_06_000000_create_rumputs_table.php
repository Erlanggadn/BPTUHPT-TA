<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRumputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rumputs', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('jenis_rumput');
            $table->string('kode_rumput', 50)->unique();
            $table->string('deskripsi_rumput')->default('tidak ada');
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
        Schema::dropIfExists('rumputs');
    }
}
