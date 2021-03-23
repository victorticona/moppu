<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuloProfileUser extends Model
{
    //
    public $timestamps = false;
    protected $table = 'module_profile_has_user';

    public function userperson()
    {
        return $this->belongsTo('App\UserPerson', 'use_id', 'use_id');
    }
}
