<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MSbank extends Model
{
    protected $table = 'mst_bank';
    protected $guarded = ['id'];
    public $timestamps = false;
}
