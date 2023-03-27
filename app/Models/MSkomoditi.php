<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MSkomoditi extends Model
{
    protected $table = 'mst_komoditi';
    protected $guarded = ['id'];
    public $timestamps = false;
}
