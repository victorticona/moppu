<?php


namespace App\SqlClasses;


class GlobalSearchSql
{
    public static function searchPersonAndOrg($data, $type = '')
    {
        if ($type != '') {
            switch ($type) {
                case 'P':
                    $str1 = ' WHERE per_is_provider <> 1 OR per_is_provider IS NULL ';
                    $str2 = ' WHERE org_is_provider <> 1 OR org_is_provider IS NULL ';
                    break;
                case 'E':
                    $str1 = ' WHERE per_is_employee <> 1 ';
                    $str2 = ' WHERE org_is_employee <> 1 ';
                    break;
                case 'C':
                    $str1 = ' WHERE per_is_client <> 1 OR per_is_client IS NULL ';
                    $str2 = ' WHERE org_is_client <> 1 OR org_is_client IS NULL ';
                    break;
                default:
                    $str1 = ' ';
                    $str2 = ' ';
            }
        } else {
            $str1 = ' ';
            $str2 = ' ';
        }
        if ($type == 'CONTACT') {
            $sql = "SELECT 
                        name, phone, nit, email, rowid, ci, type
                    FROM
                    (SELECT 
                        CONCAT_WS(' ',
                                per_name,
                                per_lastname,
                                per_lastname2) AS name,
                        per_phone AS phone,
                        per_nit AS nit,
                        per_email AS email,
                        per_id AS rowid,
                        per_ci AS ci,
                        'P' AS type
                    FROM
                        person 
                    WHERE
                        per_id NOT IN ( 
                            SELECT per_id
                            FROM contact
                            WHERE org_id ='" . $data['org_id'] . "')
                    )  AS tabla   
                    WHERE    
                        tabla.name LIKE '%" . $data['searchText'] . "%' OR 
                        ci LIKE '%" . $data['searchText'] . "%' OR 
                        nit LIKE '%" . $data['searchText'] . "%' ";
        } else {
            if ($type == 'E') {
                $sql = " SELECT name, phone, nit, email, rowid, ci, type
                from(SELECT 
                                              CONCAT_WS(' ', per_name, per_lastname, per_lastname2) AS name,
                                                  per_phone AS phone,
                                                  per_nit AS nit,
                                                  per_email AS email,
                                                  person.per_id AS rowid,
                                                  per_ci AS ci,
                                                  'P' AS type
                                          FROM
                                              person
                                          WHERE per_is_employee <> 1 and per_is_user <> 1)AS tabla
                                          WHERE
                        tabla.name LIKE '%" . $data['searchText'] . "%' OR 
                         tabla.ci LIKE '%" . $data['searchText'] . "%' OR 
                         tabla.nit LIKE '%" . $data['searchText'] . "%'";
            } else {


                $sql = "
                    SELECT 
                        name, phone, nit, email, rowid, ci, type
                    FROM
                        (SELECT 
                            org_name AS name,
                                org_phone AS phone,
                                org_nit AS nit,
                                org_mail AS email,
                                org.org_id AS rowid,
                                '' AS ci,
                                'E' AS type
                            FROM
                                org 
                            " . $str2 . "
                        UNION ALL 
                            SELECT 
                                CONCAT_WS(' ', per_name, per_lastname, per_lastname2) AS name,
                                    per_phone AS phone,
                                    per_nit AS nit,
                                    per_email AS email,
                                    person.per_id AS rowid,
                                    per_ci AS ci,
                                    'P' AS type
                            FROM
                                person
                            " . $str1 . "
                    ) AS tabla
                    WHERE
                        tabla.name LIKE '%" . $data['searchText'] . "%' OR 
                         tabla.ci LIKE '%" . $data['searchText'] . "%' OR 
                         tabla.nit LIKE '%" . $data['searchText'] . "%'";
            }
        }
        $sql .= " ORDER BY name";

        return $sql;
    }
}
