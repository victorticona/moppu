<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    //
    public $timestamps = false;
    protected $table = 'access';
    protected $primaryKey = 'acc_id';
}
