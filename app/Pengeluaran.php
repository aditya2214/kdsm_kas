<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    //
    protected $fillable = ['id_user', 'for','nominal_pengeluaran','status'];
}
