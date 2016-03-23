<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawanuploadlog extends Model
{
    protected $table = 'karyawanupload_log';
    
    protected $fillable = [
        'file_upload', 'upload_date', 'result_code'
    ];


    protected $dates = ['created_at','modified_at'];
}
