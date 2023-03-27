<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VMSkomoditi extends Model
{
    protected $table = 'view_komoditi';
    protected $guarded = ['id'];
    public $timestamps = false;
}
