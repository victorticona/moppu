<?php


namespace App\SqlClasses;


class ProductoSql
{
    public static function getList($params)
    {
        //if (!isset($params['textSearch'])) $params['textSearch'] = '';

        $sql = " select distinct p.produ_id,p.produ_codigo,p.produ_nombre,p.produ_descripcion,IF(p.catep_id=0,'sin categoria',c.catep_name)catep_name,u.unidm_nombre
        from producto p, categoria_producto c, unidad_medida u
        where p.unidm_id=u.unidm_id and (p.catep_id=c.catep_id or p.catep_id=0) ";

        return $sql;
    }
}
