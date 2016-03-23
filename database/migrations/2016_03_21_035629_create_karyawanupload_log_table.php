<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawanuploadLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawanupload_log', function (Blueprint $table) {
            $table->string('file_upload');
            $table->date('upload_date');
            $table->string('result_code');
            
            $table->increments('id');
            $table->timestamps();
            
            $table->index('file_upload');
            $table->index('upload_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('karyawanupload_log');
    }
}
