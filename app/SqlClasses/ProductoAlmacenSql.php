<?php


namespace App\SqlClasses;


class ProductoAlmacenSql
{
    public static function getList($params)
    {
        //if (!isset($params['textSearch'])) $params['textSearch'] = '';

        $sql = 'SELECT pa.almac_id,pa.produ_id,pa.cant_min,pa.cant_max,pa.cant_inicial,pa.ubicacion,a.almac_nombre
        from producto_almacen pa,almacen a
        where   a.almac_id=pa.almac_id and pa.produ_id=' . $params;

        return $sql;
    }
}
