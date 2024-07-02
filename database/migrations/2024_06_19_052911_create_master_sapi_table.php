<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterSapiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_sapi', function (Blueprint $table) {
            $table->string('sapi_id')->primary();
            $table->string('sapi_jenis');
            $table->integer('sapi_urutan_lahir');
            $table->date('sapi_tanggal_lahir');
            $table->string('sapi_no_induk');
            $table->string('sapi_keterangan');
            $table->string('sapi_kelamin');
            $table->integer('sapi_umur')->nullable(); 
            $table->string('sapi_status')->nullable(); 
            
            $table->timestamp('created_at')->useCurrent();
            $table->string('created_id', 50);
            $table->string('created_nama', 50);
            $table->timestamp('updated_at')->useCurrent();
            $table->string('updated_id', 50);
            $table->string('updated_nama', 50);

            $table->foreign('sapi_jenis')->references('sjenis_id')->on('master_sapi_jenis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_sapi');
    }
}
