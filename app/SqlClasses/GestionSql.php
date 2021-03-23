<?php


namespace App\SqlClasses;


class GestionSql
{
  public static function getList($params)
  {
    if (!isset($params['textSearch'])) $params['textSearch'] = '';

    $sql = " SELECT g.gesti_id,g.gesti_descripcion,g.gesti_fechainicio,g.gesti_fechafin,g.gesti_comodin,
        g.gesti_defecto,if(g.gesti_estado=1,'activado','desactivado')gesti_estado
        from gestion g
        where g.gesti_descripcion like '%" . $params['textSearch'] . "%' 
        or g.gesti_comodin like '%" . $params['textSearch'] . "%'
          ";

    return $sql;
  }
}
