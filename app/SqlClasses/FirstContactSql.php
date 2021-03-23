<?php


namespace App\SqlClasses;


class FirstContactSql
{
    public static function getList($params)
    {
        //if (!isset($params['textSearch'])) $params['textSearch'] = '';

        $sql = " SELECT f.fco_id,f.fco_name
        from firstcontact f ";

        return $sql;
    }
}
