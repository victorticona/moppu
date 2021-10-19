<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    //
    public $timestamps = true;
    protected $table = 'users';
    protected $primaryKey = 'id';


    public function userperson()
    {
        return $this->hasOne('App\UserPerson', 'id', 'id');
    }
}
