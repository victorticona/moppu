<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    //
    public $timestamps = false;
    protected $table = 'direccion';
    protected $primaryKey = 'dir_id';
}
