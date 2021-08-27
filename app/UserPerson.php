<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPerson extends Model
{
    //
    public $timestamps = false;
    protected $table = 'user';
    protected $primaryKey = 'use_id';
}
