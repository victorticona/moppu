<?php


namespace App\SqlClasses;


class AnuncioSql
{
  public static function getList()
  {

    $sql = "SELECT an.anu_id,p.per_id,d.dir_id,po.pdv_id,an.anu_descripcion,an.anu_fecha,an.anu_hora,an.anu_estado,an.anu_para_fec,an.anu_para_hor,
                p.per_name,p.per_lastname,
                d.dir_name,po.pdv_name
            from anuncio an,person p,direccion d,politic_division po
            where an.per_id not in (".session('per_id').") and an.per_id=p.per_id and
                p.dir_id=d.dir_id and d.pdv_id=po.pdv_id and an.anu_estado=1
                and d.dir_id=".session('dir_id')." and po.pdv_id=".session('pdv_id')."";

    return $sql;
  }
}
