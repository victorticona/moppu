<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    //
    public $timestamps = false;
    protected $table = 'anuncio';
    protected $primaryKey = 'anu_id';
}
