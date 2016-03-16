<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';
    
    protected $fillable = [
        'jabatan_kode','jabatan_nama', 'created_by', 'updated_by', 'hapus'
    ];


    protected $dates = ['created_at','modified_at'];
    
    public function karyawan()
    {
        return $this->hasMany('App\Karyawan');
    }
}
