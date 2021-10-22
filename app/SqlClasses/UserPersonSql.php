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
        where u.per_id=p.per_id and p.per_is_usuario=1 and p.dir_id=di.dir_id and u.use_id=ac.use_id and u.id=us.id and di.pdv_id=pol.pdv_id

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
    public static function getClient()
    {
        $cad="";
        
        if(session('per_is_usuario')==1){
            $cad="r.id_usr_reg=".session('use_id')." and ";
        }

        $sql = " SELECT u.use_id,u.use_username,u.nomcreador,(@dat:='')acc_value,ac.acc_state,p.per_name,p.per_lastname,p.per_lastname2,
        p.per_ci,p.dir_id,di.dir_name,pol.pdv_name,p.per_date,p.per_phone,p.per_mobile,p.per_email,
        p.per_sex,u.use_state,p.per_dirdetalle
        from (select concat(p.per_name,' ',p.per_lastname)nomcreador,u.use_id,u.use_username,u.per_id,u.id,u.use_state
              from registra r,user u,user cre, person p
              where ".$cad." r.id_usr_new=u.use_id and cre.use_id=r.id_usr_reg and cre.per_id=p.per_id)u,
              person p,direccion di, access ac, users us,politic_division pol
        where u.per_id=p.per_id and p.per_is_cliente=1 and p.dir_id=di.dir_id and u.use_id=ac.use_id and u.id=us.id and di.pdv_id=pol.pdv_id

        order by p.per_name ";

        return $sql;
    }
}
