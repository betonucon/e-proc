<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MSvendorrekening extends Model
{
    protected $table = 'mst_rekening_vendor';
    protected $guarded = ['id'];
    public $timestamps = false;
}
