<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
                
        Schema::create('karyawan', function (Blueprint $table) {
            $table->string('karyawan_pin',10)->unique();
            $table->string('karyawan_kode',20);            
            $table->string('karyawan_foto',100)->nullable();
            $table->string('karyawan_nama',50);
            $table->integer('karyawan_status')->unsigned(); //1=aktif;0=tidakaktif
            $table->date('karyawan_statustanggal');            
            $table->integer('karyawan_statuskontrak')->unsigned(); //1=kontrak;0=tetap
            $table->date('karyawan_tanggalawalkontrak')->nullable();
            $table->date('karyawan_tanggalakhirkontrak')->nullable();
            $table->integer('jabatan_id')->unsigned();
            $table->integer('divisi_id')->unsigned();
            $table->integer('perusahaan_id')->unsigned();
            $table->string('bpjs',20)->nullable();
            $table->string('asuransi',20)->nullable();
            $table->string('rekening',20)->nullable();
            $table->string('npwp',20)->nullable();
            $table->date('tanggal_npwp')->nullable();
            $table->string('inventaris')->nullable();
                        
            $table->string('jenis_kelamin',1);//L=Laki-laki;P=Perempuan
            $table->string('tempat_lahir',50);
            $table->date('tanggal_lahir');
            $table->integer('agama_id')->nullable();
            $table->text('alamat');
            $table->string('kelurahan',50)->nullable();
            $table->string('kecamatan',50)->nullable();
            $table->string('kota',30);
            $table->string('kodepos',10);
            $table->string('telpon',20);
            $table->string('handphone',20);
            $table->integer('status_rumah')->unsigned();    
            $table->integer('pendidikan')->unsigned();
            $table->string('tahun_lulus',4);
            $table->integer('status_nikah')->unsigned();
            
            
            $table->string('ktp_nik',20);
            $table->date('ktp_tanggal')->nullable();
            $table->text('ktp_alamat')->nullable();
            $table->string('ktp_kelurahan',50)->nullable();
            $table->string('ktp_kecamatan',50)->nullable();
            $table->string('ktp_kota',30)->nullable();
            $table->string('ktp_kodepos',10)->nullable();
            
            /*
             * pasangan
             */
            $table->string('pasangan_nama',50)->nullable();
            $table->string('pasangan_tempatlahir',50)->nullable();
            $table->date('pasangan_tanggallahir')->nullable();
            $table->string('pasangan_asuransi',50)->nullable();
            
            /*
             * anak 1
             */
            $table->string('anak1_nama',50)->nullable();
            $table->string('anak1_tempatlahir',50)->nullable();
            $table->date('anak1_tanggallahir',10)->nullable();
            $table->string('anak1_asuransi',50)->nullable();
            
            /*
             * anak 2
             */
            $table->string('anak2_nama',50)->nullable();
            $table->string('anak2_tempatlahir',50)->nullable();
            $table->date('anak2_tanggallahir',10)->nullable();
            $table->string('anak2_asuransi',50)->nullable();
            
            /*
             * anak 3
             */
            $table->string('anak3_nama',50)->nullable();
            $table->string('anak3_tempatlahir',50)->nullable();
            $table->date('anak3_tanggallahir',10)->nullable();
            $table->string('anak3_asuransi',50)->nullable();
            
            /*
             * ayah & ibu
             */
            $table->string('ortuayah_nama',50)->nullable();
            $table->string('ortuibu_nama',50)->nullable();
            $table->text('ortu_alamat')->nullable();
            $table->string('ortu_kota',50)->nullable();
            
            /*
             * mertua ayah & ibu
             */
            $table->string('mertuaayah_nama',50)->nullable();
            $table->string('mertuaibu_nama',50)->nullable();
            $table->text('mertua_alamat')->nullable();
            $table->string('mertua_kota',50)->nullable();
            
            /*
             * Saudara
             */
            $table->string('saudara_nama',50)->nullable();
            $table->text('saudara_alamat')->nullable();
            $table->string('saudara_tlp',30)->nullable();
            
            $table->integer('hapus')->default(1);
            $table->increments('id');
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            
            $table->foreign('jabatan_id')
                  ->references('id')->on('jabatan')
                  ->onDelete('cascade');
            
            $table->foreign('divisi_id')
                  ->references('id')->on('divisi')
                  ->onDelete('cascade');
            
            $table->foreign('perusahaan_id')
                  ->references('id')->on('perusahaan')
                  ->onDelete('cascade');
            
//            $table->foreign('agama_id')
//                  ->references('id')->on('agama')
//                  ->onDelete('cascade');
            
            $table->index('karyawan_pin');
            $table->index('karyawan_kode');
            $table->index('karyawan_nama');
            $table->index('karyawan_status');
            $table->index('karyawan_statustanggal');
            $table->index('karyawan_statuskontrak');
            $table->index('jabatan_id');
            $table->index('divisi_id');
            $table->index('perusahaan_id');
            $table->index('jenis_kelamin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('karyawan');
    }
}
