<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waktu extends Model
{
    protected $table = 'waktu';
    
    protected $fillable = [
        'waktu_kode','waktu_masuk', 'waktu_keluar', 'waktu_pendek', 'waktu_istirahat', 'waktu_warna','created_by', 'updated_by', 'hapus'
    ];


    protected $dates = ['created_at','modified_at'];
    
    public function JadwalDetail()
    {
        return $this->hasMany('App\JadwalDetail');
    }
}
