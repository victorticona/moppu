<?php


namespace App\SqlClasses;


class UnidadMedidaSql
{
    public static function getList($params)
    {
        if (!isset($params['textSearch'])) $params['textSearch'] = '';

        $sql = " SELECT unidm_id,unidm_abreviacion,unidm_nombre,if(unidm_estado=1,'activado','desactivado')unidm_estado
        from unidad_medida 
        WHERE unidad_medida.unidm_abreviacion like '%" . $params['textSearch'] . "%' or unidad_medida.unidm_nombre like '%" . $params['textSearch'] . "%'
        ORDER BY unidad_medida.unidm_nombre ";

        return $sql;
    }
}
