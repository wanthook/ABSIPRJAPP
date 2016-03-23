<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaktuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waktu', function (Blueprint $table) {
            $table->string('waktu_kode',10);
            $table->decimal('waktu_masuk',5,2);
            $table->decimal('waktu_keluar',5,2);
            $table->integer('waktu_pendek')->unsigned()->nullable();
            $table->integer('waktu_istirahat')->unsigned()->nullable();
            $table->string('waktu_warna',10);
            $table->integer('hapus')->default(1);
            $table->increments('id');
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            
            $table->index('waktu_kode');
            $table->index('hapus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('waktu');
    }
}
