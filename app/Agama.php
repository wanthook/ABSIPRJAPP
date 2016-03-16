<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    protected $table = 'agama';
    
    protected $fillable = [
        'agama_nama', 'created_by', 'updated_by', 'hapus'
    ];


    protected $dates = ['created_at','modified_at'];
    
    public function karyawan()
    {
        return $this->hasMany('App\Karyawan');
    }
}
