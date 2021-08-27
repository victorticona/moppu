<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    //
    public $timestamps = false;
    protected $table = 'module';
    protected $primaryKey = 'mod_id';
}
