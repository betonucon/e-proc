<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VMSvendorkomoditi extends Model
{
    protected $table = 'view_komoditi_vendor';
    protected $guarded = ['id'];
    public $timestamps = false;
}
