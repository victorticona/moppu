<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    public $timestamps = false;
    protected $table = 'person';
    protected $primaryKey = 'per_id';
}
