<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembeli', function (Blueprint $table) {
            $table->string('pembeli_id', 30)->primary();
            $table->unsignedBigInteger('user_id',);
            $table->string('pembeli_instansi', 50);
            $table->date('pembeli_lahir');
            $table->string('pembeli_nama', 50);
            $table->string('pembeli_alamat', 255);
            $table->bigInteger('pembeli_nohp');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembeli');
    }
}
