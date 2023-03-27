<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MSvendor extends Model
{
    protected $table = 'mst_vendor';
    protected $guarded = ['id'];
    public $timestamps = false;
}
