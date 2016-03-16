<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $table = 'divisi';
    
    protected $fillable = [
        'divisi_kode','divisi_nama', 'created_by', 'updated_by', 'hapus'
    ];


    protected $dates = ['created_at','modified_at'];
    
    public function karyawan()
    {
        return $this->hasMany('App\Karyawan');
    }
}
