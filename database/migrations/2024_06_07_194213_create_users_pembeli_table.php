<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersPembeliTable extends Migration
{
    public function up()
    {
        Schema::create('pembeli', function (Blueprint $table) {
            $table->string('id_pembeli', 255)->primary();
            $table->string('nama', 255);
            $table->string('email')->unique();
            $table->string('no_hp', 255);
            $table->string('alamat', 255);
            $table->date('tanggal_lahir');
            $table->string('password');
            $table->string('role')->default('pembeli');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembeli');
    }
}
