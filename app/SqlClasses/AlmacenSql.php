<?php


namespace App\SqlClasses;


class AlmacenSql
{
    public static function getList($params)
    {
        if (!isset($params['textSearch'])) $params['textSearch'] = '';

        $sql = " SELECT a.almac_id,e.ent_id,a.almac_nombre,a.almac_tree,a.almac_comodin,if(a.almac_estado=1,'activado','desactivado')almac_estado,
        e.ent_name,e.ent_address,e.ent_nit,e.ent_phone,e.ent_web
        from almacen a, enterprise e
        where a.ent_id=e.ent_id and 
        ( a.almac_nombre like '%" . $params['textSearch'] . "%' 
        or a.almac_comodin like '%" . $params['textSearch'] . "%'
        or e.ent_name like '%" . $params['textSearch'] . "%'  ) ";

        return $sql;
    }
}
