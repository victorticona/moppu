<?php


namespace App\SqlClasses;


class PreciosVentaSql
{
    public static function getList($params)
    {
        //if (!isset($params['textSearch'])) $params['textSearch'] = '';

        $sql = 'SELECT pr.prv_id,pr.prv_cant,pr.prv_precio,pr.prv_descuento,pr.prv_state,p.produ_nombre,
        DATE_FORMAT(pr.prv_inidate, "%m/%d/%Y") AS prv_inidate,
        DATE_FORMAT(pr.prv_enddate, "%m/%d/%Y") AS prv_enddate
        FROM precios_venta pr, producto p
        WHERE pr.produ_id=p.produ_id and p.produ_id=' . $params;

        return $sql;
    }
}
