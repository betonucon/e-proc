<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VMSvendorrekening extends Model
{
    protected $table = 'view_rekening_vendor';
    protected $guarded = ['id'];
    public $timestamps = false;
}
