<?php


namespace App\SqlClasses;


class IngresoSql
{
    public static function getList($params)
    {
        //if (!isset($params['textSearch'])) $params['textSearch'] = '';

        $sql = 'SELECT *
        from ingreso i,gestion g
        where i.gesti_id=g.gesti_id and i.almac_id=' . $params;

        return $sql;
    }
}
