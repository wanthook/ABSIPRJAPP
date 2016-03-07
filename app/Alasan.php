<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alasan extends Model
{
    protected $table = 'alasan';
    
    protected $dates = ['created_at','modified_at'];
}
