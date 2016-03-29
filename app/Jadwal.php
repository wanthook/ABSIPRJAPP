<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    
    protected $fillable = [
        'jadwal_kode','jadwal_tipe', 'created_by', 'updated_by', 'hapus'
    ];


    protected $dates = ['created_at','modified_at'];
        
    public function karyawan()
    {
        return $this->hasMany('App\Karyawan');
    }
    
    public function jadwal_detail()
    {
        return $this->hasMany('App\JadwalDetail');
    }
}
