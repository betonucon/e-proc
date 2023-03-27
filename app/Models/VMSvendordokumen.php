<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VMSvendordokumen extends Model
{
    protected $table = 'view_dokumen_vendor';
    protected $guarded = ['id'];
    public $timestamps = false;
}
