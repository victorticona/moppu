<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoliticaDivision extends Model
{
    //
    public $timestamps = false;
    protected $table = 'politic_division';
    protected $primaryKey = 'pdv_id';
}
