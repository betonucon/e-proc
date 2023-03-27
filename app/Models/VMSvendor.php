<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VMSvendor extends Model
{
    protected $table = 'view_vendor';
    protected $guarded = ['id'];
    public $timestamps = false;
}
