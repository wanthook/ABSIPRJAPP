<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_detail', function (Blueprint $table) {
            $table->integer('jadwal_id')->unsigned();
            $table->integer('waktu_id')->unsigned();
            $table->string('hari',3);
            $table->date('tanggal')->nullable();
            $table->integer('hapus')->default(1);
            $table->increments('id');
            
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            
            $table->foreign('jadwal_id')
                  ->references('id')->on('jadwal')
                  ->onDelete('cascade');
            
            $table->foreign('waktu_id')
                  ->references('id')->on('waktu')
                  ->onDelete('cascade');
            
            $table->index('tanggal');
            $table->index('hari');
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
        Schema::drop('jadwal_detail');
    }
}
