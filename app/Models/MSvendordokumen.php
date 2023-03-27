<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MSvendordokumen extends Model
{
    protected $table = 'mst_dokumen_vendor';
    protected $guarded = ['id'];
    public $timestamps = false;
}
