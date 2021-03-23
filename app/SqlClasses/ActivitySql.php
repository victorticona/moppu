<?php


namespace App\SqlClasses;


class ActivitySql
{
    public static function getList($params, $noLimit = 0)
    {
        $sql = 'SELECT
                  activity.act_name,
                  activity.act_id,
                  DATE_FORMAT(activity.act_inidate, "%m/%d/%Y") AS act_inidate,
                  DATE_FORMAT(activity.act_enddate, "%m/%d/%Y") AS act_enddate,
                  DATE_FORMAT(activity.act_initime, "%H:%i") AS act_initime,
                  DATE_FORMAT(activity.act_endtime, "%H:%i") AS act_endtime,
                  activity.act_state,
                  activity.cli_id,
                  DATE_FORMAT(activity.act_initime, "%H") AS ini_hour,
                  DATE_FORMAT(activity.act_initime, "%i") AS ini_mins,
                  DATE_FORMAT(activity.act_endtime, "%H") AS end_hour,
                  DATE_FORMAT(activity.act_endtime, "%i") AS end_mins,
                  activity.act_descr,
                  activity.aty_id,
                  activity_type.aty_name
                FROM activity
                    INNER JOIN activity_type
                    ON activity.aty_id = activity_type.aty_id
                WHERE
                    activity.act_state = 1 AND
                    activity.cli_id =' . $params['cli_id'] . ' ORDER BY act_inidate DESC, act_enddate DESC, activity.act_initime DESC, activity.act_endtime DESC ';
        if ($noLimit == 1) {
            $sql .= "LIMIT " . (($params['page'] - 1) * $params['rows']) . ", " . $params['rows'];
        }
        return $sql;
    }

    public static function getActivity($act_id)
    {
        $sql = $sql = 'SELECT
                  activity.act_name,
                  activity.act_id,
                  DATE_FORMAT(activity.act_inidate, "%m/%d/%Y") AS act_inidate,
                  DATE_FORMAT(activity.act_enddate, "%m/%d/%Y") AS act_enddate,
                  DATE_FORMAT(activity.act_initime, "%H:%i") AS act_initime,
                  DATE_FORMAT(activity.act_endtime, "%H:%i") AS act_endtime,
                  activity.act_state,
                  activity.cli_id,
                  DATE_FORMAT(activity.act_initime, "%H") AS ini_hour,
                  DATE_FORMAT(activity.act_initime, "%i") AS ini_mins,
                  DATE_FORMAT(activity.act_endtime, "%H") AS end_hour,
                  DATE_FORMAT(activity.act_endtime, "%i") AS end_mins,
                  activity.act_color,
                  activity.act_descr,
                  activity.aty_id,
                  activity_type.aty_name
                FROM activity
                    INNER JOIN activity_type
                    ON activity.aty_id = activity_type.aty_id
                WHERE
                    activity.act_state = 1 AND
                    activity.act_id =' . $act_id;
        return $sql;
    }
}
