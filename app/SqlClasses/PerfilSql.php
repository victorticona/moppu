<?php


namespace App\SqlClasses;


class PerfilSql
{
    public static function getList($params)
    {
        if (!isset($params['textSearch'])) $params['textSearch'] = '';

        $sql = " SELECT pro_id,pro_name,pro_state FROM profile ";

        return $sql;
    }
}
