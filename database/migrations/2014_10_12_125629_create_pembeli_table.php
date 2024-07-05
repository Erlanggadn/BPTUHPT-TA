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
            $table->string('pembeli_id')->primary();
            $table->unsignedBigInteger('pembeli_detail');
            $table->string('pembeli_instansi');
            $table->date('pembeli_lahir');
            $table->string('pembeli_nama');
            $table->string('pembeli_alamat');
            $table->bigInteger('pembeli_nohp');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('pembeli_detail')->references('id')->on('users')->onDelete('cascade');
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
