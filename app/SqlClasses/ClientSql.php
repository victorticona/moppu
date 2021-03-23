<?php


namespace App\SqlClasses;


class ClientSql
{
  public static function getList($data, $flag = '')
  {
    $sql = "SELECT
                  crt_id, crt_name, cli_id, cli_date, per_id, org_id,
                  emp_id, cli_state, fco_id, fco_name, type,
                  name, phone, mobile, email, pdv_id, pdv_name, is_client
              FROM
                  (SELECT
                    crmtype.crt_id,
                    crmtype.crt_name,
                    client.cli_id,
                    client.cli_date,
                    client.per_id,
                    client.org_id,
                    client.emp_id,
                    client.cli_state,
                    firstcontact.fco_id,
                    firstcontact.fco_name,
                    CONCAT_WS(' ', person.per_name, person.per_lastname, person.per_lastname2) as name,
                    person.per_phone as phone,
                    person.per_mobile as mobile,
                    person.per_email as email,
                    politic_division.pdv_id,
                    politic_division.pdv_name,
                    'P' AS type,
                    person.per_is_client as is_client
                  FROM crmtype
                    INNER JOIN client
                      ON crmtype.crt_id = client.crt_id
                    INNER JOIN person
                      ON person.per_id = client.per_id
                    INNER JOIN politic_division
                      ON politic_division.pdv_id = person.pdv_id
                    INNER JOIN firstcontact
                      ON firstcontact.fco_id = client.fco_id
                  WHERE
                    person.per_is_client = 1 and " . session('__emp_id') . "=client.emp_id
              UNION ALL
                  SELECT
                    crmtype.crt_id,
                    crmtype.crt_name,
                    client.cli_id,
                    client.cli_date,
                    client.per_id,
                    client.org_id,
                    client.emp_id,
                    client.cli_state,
                    firstcontact.fco_id,
                    firstcontact.fco_name,
                    org.org_name as name,
                    org.org_phone as phone,
                    org.org_fax as mobile,
                    org.org_mail as email,
                    politic_division.pdv_id,
                    politic_division.pdv_name,
                    'E' AS type,
                    org.org_is_client
                  FROM crmtype
                    INNER JOIN client
                      ON crmtype.crt_id = client.crt_id
                    INNER JOIN org
                      ON org.org_id = client.org_id
                    INNER JOIN politic_division
                      ON politic_division.pdv_id = org.pdv_id
                    INNER JOIN firstcontact
                      ON firstcontact.fco_id = client.fco_id
                  WHERE
                    org.org_is_client = 1 AND client.emp_id=" . session('__emp_id') . ") AS tabla
              WHERE
              ";

    if (($flag != '') && ($flag == 'CONVERT')) {
      $sql .= ' tabla.cli_id=' . $data['textSearch'];
    } else {
      $sql .= " tabla.type LIKE '%" . $data["filterType"] . "%' AND
                  (tabla.name LIKE '%" . $data["textSearch"] . "%' OR
                   tabla.phone LIKE '%" . $data["textSearch"] . "%' OR
                   tabla.email LIKE '%" . $data["textSearch"] . "%' OR
                   tabla.mobile LIKE '%" . $data["textSearch"] . "%') ";
    }
    $sql .= " ORDER BY name";

    return $sql;
  }
}
