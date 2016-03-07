<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module', function (Blueprint $table) {
            $table->string('nama',100);
            $table->string('desc',100);
            $table->string('route',100);
            $table->string('param',100);
            $table->integer('parent');
            $table->string('selected',100);
            $table->string('icon',50)->nullable();
            $table->integer('order')->nullable();
            $table->integer('hapus')->default('1');
            $table->increments('id');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            
            $table->index('hapus');
            $table->index('nama');
            $table->index('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('module');
    }
}
