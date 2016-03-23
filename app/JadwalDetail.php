<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalDetail extends Model
{
    protected $table = 'jadwal_detail';
    
    protected $fillable = [
        'jadwal_id','waktu_id', 'hari','tanggal', 'created_by', 'updated_by', 'hapus'
    ];


    protected $dates = ['created_at','modified_at'];
    
    public function jadwal()
    {
        return $this->belongsTo('App\Jadwal');
    }
    
    public function waktu()
    {
        return $this->belongsTo('App\Waktu');
    }
}
