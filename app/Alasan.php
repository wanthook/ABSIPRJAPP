<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alasan extends Model
{
    protected $table = 'alasan';
    
    protected $fillable = [
        'alasan_kode','alasan_nama', 'created_by', 'updated_by'
    ];


    protected $dates = ['created_at','modified_at'];
}
