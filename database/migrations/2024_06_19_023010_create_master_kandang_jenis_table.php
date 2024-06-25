<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKandangJenisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_kandang_jenis', function (Blueprint $table) {
            $table->string('kandang_id')->primary();
            $table->string('kandang_tipe', 50);
            $table->string('kandang_keterangan', 50);
            
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
        Schema::dropIfExists('master_kandang_jenis');
    }
}
