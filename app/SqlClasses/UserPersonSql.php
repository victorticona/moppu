<?php


namespace App\SqlClasses;

use Illuminate\Support\Facades\Auth;

class UserPersonSql
{
    public static function getList()
    {

        $sql = " SELECT p.per_id,u.use_id,ac.acc_id,us.id,po.pdv_id,u.use_username,ac.acc_state,p.per_name,p.per_lastname,p.per_lastname2,
        p.per_ci,po.pdv_name,p.per_date,p.per_phone,p.per_mobile,p.per_email,
        p.per_sex,u.use_state,ac.acc_value
        from user u,person p,politic_division po, access ac, users us
        where u.per_id=p.per_id and p.per_is_usuario=1 and p.pdv_id=po.pdv_id and u.use_id=ac.use_id and u.id=us.id

        order by p.per_name ";

        return $sql;
    }
    public static function getUser()
    {
        //dd(auth()->user()->id);

        $sql = " SELECT pol.pdv_id,pol.pdv_name,u.use_username,p.per_name,p.per_lastname,p.per_lastname2,
                p.per_ci,p.per_date,p.per_phone,p.per_mobile,p.per_email,
                p.per_sex,
                us.created_at, us.updated_at
                from user u,person p, access ac, users us,politic_division pol
                where u.id=" . auth()->user()->id . " and u.per_id=p.per_id  and  u.use_id=ac.use_id and u.id=us.id and p.pdv_id=pol.pdv_id
        ";

        return $sql;
    }
}
