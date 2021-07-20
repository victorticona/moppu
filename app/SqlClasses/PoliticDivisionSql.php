<?php


namespace App\SqlClasses;


class PoliticDivisionSql
{
    public static function getList()
    {


        $sql = " SELECT pdv_id,pdv_name,pdv_estado
        from politic_division
        ORDER BY politic_division.pdv_id ";

        return $sql;
    }
}
