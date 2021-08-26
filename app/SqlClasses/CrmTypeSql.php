<?php


namespace App\SqlClasses;


class CrmTypeSql
{
    public static function getList($params)
    {
        //if (!isset($params['textSearch'])) $params['textSearch'] = '';

        $sql = " SELECT f.crt_id,f.crt_name
        from crmtype f ";

        return $sql;
    }
}
