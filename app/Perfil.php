<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    //
    public $timestamps = false;
    protected $table = 'profile';
    protected $primaryKey = 'pro_id';
}
