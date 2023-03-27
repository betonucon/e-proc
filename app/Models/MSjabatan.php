<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MSjabatan extends Model
{
    protected $table = 'mst_jabatan';
    protected $guarded = ['id'];
    public $timestamps = false;
}
