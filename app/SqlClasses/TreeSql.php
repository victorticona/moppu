<?php


namespace App\SqlClasses;

use App\PhpClasses;


class TreeSql
{
    /**
     * @param PhpClasses\Tree $tree
     * @param array $id
     * @param array $idEx
     * @return string
     */
    public static function reIndexStatements(PhpClasses\Tree $tree, $id = array(), $idEx = array())
    {
        if (empty($id) && empty($idEx)) {
            return "SELECT * FROM " . $tree->getTable() . " ORDER BY " . $tree->getTree() . " ASC";
        } elseif (!empty($id) && empty($idEx)) {
            return "SELECT 
                        *
                    FROM
                        " . $tree->getTable() . "
                    WHERE
                         " . $tree->getTree() . " LIKE '" . $id[$tree->getTree()] . "%'
                    ORDER BY " . $tree->getTree() . " ASC";
        } elseif (empty($id) && !empty($idEx)) {
            return "SELECT 
                        *
                    FROM
                        " . $tree->getTable() . "
                    WHERE
                         " . $tree->getPk() . " NOT IN(SELECT 
                                                        " . $tree->getPk() . "
                                                    FROM
                                                        " . $tree->getTable() . "
                                                    WHERE
                                                         " . $tree->getTree() . " LIKE '" . $idEx[$tree->getTree()] . "%' 
                                                    ORDER BY " . $tree->getTree() . " ASC)
                                                    ORDER BY " . $tree->getTree() . " ASC";
        } elseif (!empty($id) && !empty($idEx)) {
            return "SELECT 
                        *
                    FROM
                        " . $tree->getTable() . "
                    WHERE
                         " . $tree->getTree() . " LIKE '" . $id[$tree->getTree()] . "%' AND
                         " . $tree->getPk() . " NOT IN(SELECT 
                                            mod_id
                                        FROM
                                            module
                                        WHERE
                                             " . $tree->getTree() . " LIKE '" . $idEx[$tree->getTree()] . "%' 
                                        ORDER BY " . $tree->getTree() . " ASC)
                                        ORDER BY " . $tree->getTree() . " ASC";
        }
    }
}
