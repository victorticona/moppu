<?php


namespace App\SqlClasses;


class ProviderSql
{
    public static function getList($data, $flag = '')
    {
        $sql = "
                SELECT
                    name, phone, nit, email, rowid, ci, type, pro_id
                FROM
                    (SELECT
                        org_name AS name,
                        org_phone AS phone,
                        org_nit AS nit,
                        org_mail AS email,
                        org.org_id AS rowid,
                        '' AS ci,
                        'E' AS type,
                        provider.pro_id AS pro_id
                    FROM
                        org
                        INNER JOIN provider ON(org.org_id = provider.org_id)
                    WHERE
                        org_is_provider = 1 UNION ALL
                    SELECT
                        CONCAT_WS(' ', per_name, per_lastname, per_lastname2) AS name,
                            per_phone AS phone,
                            per_nit AS nit,
                            per_email AS email,
                            person.per_id AS rowid,
                            per_ci AS ci,
                            'P' AS type,
                            provider.pro_id AS pro_id
                    FROM
                        person
                        INNER JOIN provider ON(person.per_id = provider.per_id)
                    WHERE
                        per_is_provider = 1) AS tabla
                WHERE
                ";

        if (($flag != '') && ($flag == 'CONVERT')) {
            $sql .= ' tabla.pro_id=' . $data['textSearch'];
        } else {
            $sql .= " tabla.type LIKE '%" . $data["filterType"] . "%' AND
                    (tabla.name LIKE '%" . $data["textSearch"] . "%' OR
                     tabla.ci LIKE '%" . $data["textSearch"] . "%' OR
                     tabla.nit LIKE '%" . $data["textSearch"] . "%') ";
        }
        $sql .= " ORDER BY name";

        return $sql;
    }
}
