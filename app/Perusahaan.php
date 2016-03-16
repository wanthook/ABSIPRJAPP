<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $table = 'perusahaan';
    
    protected $fillable = [
        'perusahaan_kode','perusahaan_nama', 'created_by', 'updated_by', 'hapus'
    ];


    protected $dates = ['created_at','modified_at'];
    
    public function karyawan()
    {
        return $this->hasMany('App\Karyawan');
    }
}
