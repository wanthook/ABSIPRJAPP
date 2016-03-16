<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libur extends Model
{
    protected $table = 'libur';
    
    protected $fillable = [
        'tanggal','keterangan', 'created_by', 'updated_by', 'hapus'
    ];


    protected $dates = ['created_at','modified_at'];
}
