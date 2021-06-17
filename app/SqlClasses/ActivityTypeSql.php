<?php


namespace App\SqlClasses;


class ActivityTypeSql
{
    public static function getList($params)
    {
        //if (!isset($params['textSearch'])) $params['textSearch'] = '';

        $sql = " SELECT a.aty_id,a.aty_name
        from activity_type a ";

        return $sql;
    }
}
