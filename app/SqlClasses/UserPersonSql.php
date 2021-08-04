<?php


namespace App\SqlClasses;

use Illuminate\Support\Facades\Auth;

class UserPersonSql
{
    public static function getList()
    {

        $sql = " SELECT u.use_id,u.use_username,(@dat:='')acc_value,ac.acc_state,p.per_name,p.per_lastname,p.per_lastname2,
        p.per_ci,p.dir_id,di.dir_name,pol.pdv_name,p.per_date,p.per_phone,p.per_mobile,p.per_email,
        p.per_sex,u.use_state,p.per_dirdetalle
        from user u,person p,direccion di, access ac, users us,politic_division pol
        where u.per_id=p.per_id and p.per_is_usuario=1 and p.dir_id=di.dir_id and u.use_id=ac.use_id and u.id=us.id and di.dir_designacion=pol.pdv_id

        order by p.per_name ";

        return $sql;
    }
    public static function getUser()
    {
        //dd(auth()->user()->id);

        $sql = " SELECT di.dir_id,di.dir_name,u.use_username,p.per_name,p.per_lastname,p.per_lastname2,
                p.per_ci,p.per_date,p.per_phone,p.per_mobile,p.per_email,
                p.per_sex,
                us.created_at, us.updated_at
                from user u,person p, access ac, users us,direccion di
                where u.id=" . auth()->user()->id . " and u.per_id=p.per_id  and  u.use_id=ac.use_id and u.id=us.id and p.dir_id=di.dir_id
        ";

        return $sql;
    }
}
