<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MSvendorkomoditi extends Model
{
    protected $table = 'mst_komoditi_vendor';
    protected $guarded = ['id'];
    public $timestamps = false;
}
