<?php


namespace App\SqlClasses;


class EmployeeSql
{
  public static function getList($params)
  {

    if (!isset($params['is_user'])) $params['is_user'] = '';
    if (!isset($params['textSearch'])) $params['textSearch'] = '';
    $use = "fas fa-user-plus";
    $emp = "fa fa-suitcase";

    $ico1 = '<i class="  ' . $use . '  " title="usuario"></i>';
    $ico2 = '<i class="  ' . $emp . '  " title="empleado"></i>';

    /*$sql = "SELECT 
                            employee.emp_id,
                            employee.emp_date,
                            employee.emp_state,
                            person.per_id,
                            person.per_name,
                            person.per_lastname,
                            person.per_lastname2,
                            person.per_ci,
                            person.per_date,
                            person.per_phone,
                            person.per_mobile,
                            person.per_email,
                            concat('<center>',
                            if(person.per_is_user=1,'" . $ico1 . "',' '),' ',
                            if(person.per_is_client=1,'" . $ico2 . "',' '),' ',
                            if(person.per_is_employee=1,'" . $ico3 . "',' '),' ',
                            if(person.per_is_provider=1,'" . $ico4 . "',' '),' ', 
                            '</center>' )tipo,
                            person.pdv_id,
                            person.per_sex,
                            enterprise.ent_id,
                            enterprise.ent_name,
                            enterprise.ent_state
                        FROM
                            employee
                                LEFT OUTER JOIN
                            person ON (person.per_id = employee.per_id)
                                LEFT OUTER JOIN
                            enterprise ON (employee.ent_id = enterprise.ent_id)
                        WHERE ";
    if ($params['is_user'] == '') {
      // nothing to do
    } else if ($params['is_user'] == 1) {
      $sql .= "person.per_id IN (SELECT
                              person.per_id
                            FROM
                              person
                              INNER JOIN user ON (person.per_id = user.per_id)
                            WHERE
                              user.use_state = 1) AND ";
    } else if ($params['is_user'] == 0) {
      $sql .=  "person.per_id NOT IN(SELECT
                              person.per_id
                            FROM
                              person
                              INNER JOIN user ON (person.per_id = user.per_id)
                            WHERE
                              user.use_state = 1) AND ";
    }
    $sql .= " employee.emp_state=1 and
                        (person.per_name like '%" . $params["textSearch"] . "%' or
                        person.per_lastname like '%" . $params["textSearch"] . "%' or
                        person.per_lastname2 like '%" . $params["textSearch"] . "%' or
                        person.per_ci like '%" . $params["textSearch"] . "%')
                        ORDER BY person.per_name
                    ";
    return $sql;*/
    $sql = "SELECT 
    p.per_id,
    p.per_name,
    p.per_lastname,
    p.per_lastname2,
    p.per_ci,
    p.per_date,
    p.per_phone,
    p.per_mobile,
    p.per_email,
    concat('<center>',
    if(p.per_is_user=1,'" . $ico1 . "',' '),' ',
    if(p.per_is_employee=1,'" . $ico2 . "',' '),' ',
    '</center>' )tipo,
    p.pdv_id,
    p.per_sex
    FROM person p, politic_division po
    WHERE p.pdv_id=po.pdv_id and (p.per_is_employee=1 or p.per_is_user=1)";
    $sql .= "  and
                        (p.per_name like '%" . $params["textSearch"] . "%' or
                        p.per_lastname like '%" . $params["textSearch"] . "%' or
                        p.per_lastname2 like '%" . $params["textSearch"] . "%' or
                        p.per_ci like '%" . $params["textSearch"] . "%')
                        ORDER BY p.per_name
                    ";
    return $sql;
  }
}
