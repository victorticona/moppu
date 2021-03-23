<?php


namespace App\SqlClasses;


class ContactSql
{
    public static function getList($params, $noLimit = 0) {
        $sql = 'SELECT 
                    contact.org_id,
                    person.per_id,
                    person.per_name,
                    person.per_lastname,
                    person.per_lastname2,
                    person.per_ci,
                    person.per_nit,
                    person.per_date,
                    person.per_phone,
                    person.per_mobile,
                    person.per_email,
                    person.per_is_client,
                    person.per_is_provider,
                    person.per_is_user,
                    person.pdv_id,
                    person.per_is_employee,
                    person.per_sex
                FROM
                    contact
                        INNER JOIN
                    person ON (person.per_id = contact.per_id)
                WHERE
                    contact.org_id ='.$params['org_id']." ORDER BY per_name ASC ";
        if ($noLimit == 1) {
            $sql .= "LIMIT " . (($params['page'] - 1) * $params['rows']) . ", " . $params['rows'];
        }
        return $sql;
    }

    public static function getContact($org_id, $per_id) {
        $sql = 'SELECT 
                    contact.org_id,
                    person.per_id,
                    person.per_name,
                    person.per_lastname,
                    person.per_lastname2,
                    person.per_ci,
                    person.per_nit,
                    person.per_date,
                    person.per_phone,
                    person.per_mobile,
                    person.per_email,
                    person.per_is_client,
                    person.per_is_provider,
                    person.per_is_user,
                    person.pdv_id,
                    person.per_is_employee,
                    person.per_sex
                FROM
                    contact
                        INNER JOIN
                    person ON (person.per_id = contact.per_id)
                WHERE
                    contact.org_id ='.$org_id.' AND
                    contact.per_id ='.$per_id;
        return $sql;
    }
}
