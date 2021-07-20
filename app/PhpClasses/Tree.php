<?php


namespace App\PhpClasses;

use Illuminate\Support\Facades\DB;
use App\SqlClasses\TreeSql;
use App\PoliticaDivision;

class Tree
{
    private $Table;
    private $Length;
    private $Separator;
    private $Pk;
    private $B;
    private $FieldPrefix;
    private $Name;
    private $Tree;
    private $Level;
    private $HasChild;
    private $ActualNode;
    private $FatherNode;
    private $PkValue;
    private $FieldName;
    private $fatherField;

    /**
     * TreeNew constructor.
     * @param $B
     */
    public function __construct($B = '')
    {
        $this->B = $B;
        $this->Length = 3;
        $this->Separator = ".";
        // default values
        $this->setName('name');
        $this->setTree('tree');
        $this->setLevel('level');
        $this->setHasChild('haschild');
        $this->FieldName = $this->getFieldPrefix() . 'name';
    }

    /**
     * @return mixed
     */
    public function getFieldPrefix()
    {
        return $this->FieldPrefix;
    }

    /**
     * @param mixed $FieldPrefix
     */
    public function setFieldPrefix($FieldPrefix)
    {
        $this->FieldPrefix = $FieldPrefix;
    }

    /**
     * @return string
     */
    public function getFieldName(): string
    {
        return $this->FieldName;
    }

    /**
     * @param string $FieldName
     */
    public function setFieldName(string $FieldName): void
    {
        $this->FieldName = $FieldName;
    }

    /**
     * @return mixed
     */
    public function getB()
    {
        return $this->B;
    }

    /**
     * @return mixed
     */
    public function getActualNode()
    {
        return $this->ActualNode;
    }

    /**
     * @param mixed $ActualNode
     */
    public function setActualNode($ActualNode)
    {
        $this->ActualNode = $ActualNode;
    }

    /**
     * @return mixed
     */
    public function getFatherNode()
    {
        return $this->FatherNode;
    }

    /**
     * @param mixed $FatherNode
     */
    public function setFatherNode($FatherNode)
    {
        $this->FatherNode = $FatherNode;
    }

    /**
     * @return mixed
     */
    public function getPkValue()
    {
        return $this->PkValue;
    }

    /**
     * @param mixed $PkValue
     */
    public function setPkValue($PkValue)
    {
        $this->PkValue = $PkValue;
    }

    /**
     * Obtiene el nivel del nodo actual partiendo de la cadena
     * @return int
     */
    function getLevelActual()
    {
        if (strlen($this->ActualNode[$this->getTree()]) == $this->getLength()) {
            return 0;
        } else {
            return substr_count($this->ActualNode[$this->getTree()], $this->getSeparator());
        }
    }

    /**
     * @return mixed
     */
    public function getTree()
    {
        return $this->Tree;
    }

    /**
     * @param mixed $Tree
     */
    public function setTree($Tree)
    {
        $this->Tree = $Tree;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->Length;
    }

    /**
     * @param mixed $Length
     */
    public function setLength($Length)
    {
        $this->Length = $Length;
    }

    /**
     * @return string
     */
    public function getSeparator()
    {
        return $this->Separator;
    }

    /**
     * @param mixed $Separator
     */
    public function setSeparator($Separator)
    {
        $this->Separator = $Separator;
    }

    public function getAllForCombo()
    {
        $d = $this->getAll();
        if ($d['total'] == 0) {
            $d['rows'] = array();
        }
        $data = $d['rows'];
        $val = array();
        $i = 0;
        $str = '';
        $prev = array($this->getLevel() => '');
        $tope = count($data);
        //var_dump($prev);
        foreach ($data as $v) {
            if ($i == 0) {
                $str .= '[';
                $str .= '{ "id": 0, "name": "Sin dependencias","locked": true}';
                $prev = $v;
            }
            //var_dump($v);
            if ($prev[$this->getLevel()] == $v[$this->getLevel()]) {
                $str .= ',';
            } elseif ($prev[$this->getLevel()] > $v[$this->getLevel()]) {
                $close = $prev[$this->getLevel()] - $v[$this->getLevel()];
                if ($close == 1) $str .= ']},';
                elseif ($close == 0) {
                    for ($j = 0; $j < $prev[$this->getLevel()]; $j++) {
                        $str .= ']}';
                    }
                    if ($i < $tope) $str .= ',';
                } elseif ($close > 1) {
                    for ($j = 0; $j < $close; $j++) {
                        $str .= ']}';
                    }
                    if ($i < $tope) $str .= ',';
                }
            }
            if ($v[$this->HasChild] == 1) {
                $str .= '{"id": "' . $v[$this->Pk] . '", '
                    . '"name": "' . $v[$this->FieldName] . '", '
                    . '"children":[ ';
                $prev = $v;
            } else {
                $str .= '{"id": "' . $v[$this->Pk] . '", '
                    . '"name": "' . $v[$this->FieldName] . '"}';
                $prev = $v;
            }
            $i++;
        }
        if ($prev[$this->getLevel()] == 0) $str .= ']';
        else {
            for ($j = 0; $j < $prev[$this->getLevel()]; $j++) {
                $str .= ']}';
            }
            $str .= ']';
        }

        return $str;
    }

    public function getAllForComboDir()
    {
        $d = $this->getAll();

        if ($d['total'] == 0) {
            $d['rows'] = array();
            $str = "[";
        } else {
            $str = '';
        }
        $data = $d['rows'];

        $val = array();
        $i = 0;
        $prev = array($this->getLevel() => '');
        $tope = count($data);


        foreach ($data as $v) {

            $desig = PoliticaDivision::where("pdv_id", "=", $v['dir_designacion'])->get()->toArray();
            $desig = $desig[0];
            if ($i == 0) {
                $str .= '[';
                //$str .= '{ "id": 0, "name": "Vicok","locked": true}';
                $prev = $v;
            }
            if ($prev[$this->getLevel()] == $v[$this->getLevel()] && $prev[$this->getLevel()] != 0) {
                $str .= ',';
            } elseif ($prev[$this->getLevel()] > $v[$this->getLevel()]) {
                $close = $prev[$this->getLevel()] - $v[$this->getLevel()];
                if ($close == 1) $str .= ']},';
                elseif ($close == 0) {
                    for ($j = 0; $j < $prev[$this->getLevel()]; $j++) {
                        $str .= ']}';
                    }
                    if ($i < $tope) $str .= ',';
                } elseif ($close > 1) {
                    for ($j = 0; $j < $close; $j++) {
                        $str .= ']}';
                    }
                    if ($i < $tope) $str .= ',';
                }
            }
            if ($v[$this->HasChild] == 1) {
                $str .= '{"id": "' . $v[$this->Pk] . '", '
                    . '"name": "' . $v[$this->FieldName] . '", '
                    . '"designacion": " ' . $desig['pdv_name'] . ' ", '
                    . '"children":[ ';
                $prev = $v;
            } else {
                $str .= '{"id": "' . $v[$this->Pk] . '", '
                    . '"designacion": " ' . $desig['pdv_name'] . ' ", '
                    . '"name": "' . $v[$this->FieldName] . '"}';
                $prev = $v;
            }
            $i++;
        }
        if ($prev[$this->getLevel()] == 0) $str .= ']';
        else {
            for ($j = 0; $j < $prev[$this->getLevel()]; $j++) {
                $str .= ']}';
            }
            $str .= ']';
        }
        //dd($str);
        return $str;
    }

    public function getAll()
    {
        $data = DB::table($this->Table)->orderBy($this->getTree(), 'asc')->get();
        $result = array();
        $result["total"] = count($data);
        $i = 0;
        foreach ($data as $v) {
            $d = get_object_vars($v);
            $this->setActualNode($d);
            $result["rows"][$i] = $d;
            if ($d[$this->getFatherField()] != 0) {
                $result["rows"][$i]['_parentId'] = $d[$this->getFatherField()];
            }
            $i++;
        }
        return $result;
    }

    /**
     * Inserta un nodo desde un array de datos
     * @param $data
     * @return array $rest
     */
    public function insertNode($data)
    {
        $data[$this->getTree()] = $this->getNewNode($data[$this->getFatherField()]);
        $data[$this->getLevel()] = $this->getLevelFromTree($data[$this->getTree()]);
        $data[$this->getHasChild()] = 0;
        if ($data[$this->getFatherField()] == '') $data[$this->getFatherField()] = 0;
        DB::beginTransaction();
        try {
            $modId = DB::table($this->getTable())->insertGetId($data);
            if ($data[$this->getFatherField()] != 0) {
                $f = $this->getNode($data[$this->getFatherField()]);
                $f = $f[0];
                $f = get_object_vars($f);
                $f[$this->getHasChild()] = 1;
                DB::table($this->getTable())
                    ->where($this->getPk(), $data[$this->getFatherField()])
                    ->update($f);
            }
            DB::commit();
            $rest = [
                'success' => true,
                'msg' => 'Datos registrados correctamente',
                'mod_id' => $modId
            ];
        } catch (\Exception $e) {
            $rest = [
                'success' => false,
                'msg' => 'Error al intentar registrar' . $e
            ];
        }
        return $rest;
    }

    /**
     * Genera un nuevo codigo del tipo arbol a partir del padre
     * @param string $father
     * @return string
     */
    function getNewNode($father = '')
    {
        $code = '';
        if (($father == '') or ($father == 0)) {
            $father = 0;
            $f = DB::table($this->Table)->where($this->fatherField, '=', 0)->orderBy($this->getTree(), 'desc')->first();
            if ($f === null) {
                $code = $this->zeroFill(1, $this->Length); // arbol vacio
            } else {
                $d = get_object_vars($f);
                $code = $this->zeroFill((int)$d[$this->getTree()] + 1, $this->Length);
            }
        } else {
            $f = DB::table($this->Table)->where($this->fatherField, '=', $father)->orderBy($this->getTree(), 'desc')->first();
            if ($f === null) {
                $n = $this->getNode($father);
                $d = $n[0];
                $d = get_object_vars($d);
                $code = $d[$this->getTree()] . $this->getSeparator() . $code = $this->zeroFill(1, $this->Length);
            } else {
                $d = get_object_vars($f);
                $s = substr($d[$this->getTree()], -3);
                $p = substr($d[$this->getTree()], 0, -3);
                $code = $p . $this->zeroFill((int)$s + 1, $this->Length);
            }
        }
        return $code;
    }

    /**
     *
     * Permite completar lo indices en cantidad y valores cero
     * @param int $Num valor tomado
     * @param int $Length longitud de los indexadores
     * @return string
     */
    public static function zeroFill($Num, $Length)
    {
        $NumStr = "$Num";
        $Str = '';
        for ($i = 0; $i < ($Length - strlen($NumStr)); $i++) {
            $Str = "0" . $Str;
        }
        return $Str . $Num;
    }

    /**
     *
     * Obtiene la informacion de un nodo $Id
     * @param string $N codigo del nodo
     * @return bool
     *
     */
    function getNode($Id)
    {
        $row = DB::table($this->Table)->where($this->getPk(), '=', $Id)->get();
        $this->setActualNode($row->toArray());
        return $row->toArray();
    }

    /**
     * @return mixed
     */
    public function getPk()
    {
        return $this->Pk;
    }

    /**
     * @param mixed $Pk
     */
    public function setPk($Pk)
    {
        $this->Pk = $Pk;
    }

    /**
     * @return mixed
     */
    public function getFatherField()
    {
        return $this->fatherField;
    }

    /**
     * @param mixed $fatherField
     */
    public function setFatherField($fatherField): void
    {
        $this->fatherField = $fatherField;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->Level;
    }

    /**
     * @param mixed $Level
     */
    public function setLevel($Level)
    {
        $this->Level = $Level;
    }

    public function getLevelFromTree($Tree)
    {
        return substr_count($Tree, $this->Separator);
    }

    /**
     * @return mixed
     */
    public function getHasChild()
    {
        return $this->HasChild;
    }

    /**
     * @param mixed $HasChild
     */
    public function setHasChild($HasChild)
    {
        $this->HasChild = $HasChild;
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->Table;
    }

    /**
     * @param mixed $Table
     */
    public function setTable($Table)
    {
        $this->Table = $Table;
    }

    public function updateNode($data)
    {
        $node = $this->getNode($data[$this->getPk()]);
        $node = $node[0];
        $node = get_object_vars($node);
        // hay cambio de rama
        if ($node[$this->getFatherField()] == $data[$this->getFatherField()]) {
            DB::table($this->getTable())->where($this->getPk(), '=', $node[$this->getPk()])->update($data);
            $rest = [
                'success' => true,
                'msg' => 'Registro actualizado sin cambio de rama'
            ];
        } else {
            $first = $this->getFirstNodeTree();
            $first = get_object_vars($first);
            if ($first[$this->getPk()] == $data[$this->getPk()]) {
                $rest = [
                    'success' => false,
                    'msg' => 'NO es posible mover el nodo padre de todo el arbol'
                ];
            } else {
                // actualizamos los datos enviados, menos los campos del arbol
                $aux = $data[$this->getFatherField()];
                $data[$this->getTree()] = $node[$this->getTree()];
                $data[$this->getFatherField()] = $node[$this->getFatherField()];
                DB::table($this->getTable())
                    ->where($this->getPk(), '=', $node[$this->getPk()])->update($data);
                // para mover la rama restauramos el cambio
                $data[$this->getFatherField()] = $aux;
                $r = $this->moveBranch($node[$this->getPk()], $data[$this->getFatherField()]);
                $rest = $r;
            }
        }
        return $rest;
    }

    public function getFirstNodeTree()
    {
        $r = DB::table($this->getTable())->orderBy($this->getTree(), 'asc')->first();
        return $r;
    }

    /**
     * Mueve una rama del arbol que inicia en id a toDependent como hijo
     * @param $id // nunca es cero
     * @param $toDependent // cuando es cero es raiz
     * @return array
     */
    public function moveBranch($id, $toDependent)
    {
        $from = $this->getNode($id);
        $from = $from[0];
        $from = get_object_vars($from);
        if ($toDependent != 0) {
            $to = $this->getNode($toDependent);
            $to = $to[0];
            $to = get_object_vars($to);
        } else {
            $to = array();
        }
        // obtenemos el nuevo tree
        $newNode = $this->getNewNode($toDependent);
        // obtenemos su branch
        $rIn = array();
        $h = $this->getBranch($from[$this->getPk()]);
        $i = 0; // para mover la dependencia
        foreach ($h as $v) {
            $v = get_object_vars($v);
            $v[$this->getTree()] = preg_replace('/^' . $from[$this->getTree()] . '/', $newNode, $v[$this->getTree()], 1);
            $v[$this->getLevel()] = substr_count($v[$this->getTree()], $this->getSeparator());
            if ($i == 0) {
                $v[$this->getFatherField()] = $toDependent;
                $i++;
            }
            $rIn[] = $v;
        }
        // preguntamos si from tiene al menos un hermano, sino cambiamos haschild del padre
        $bro = $this->getBrothers($id);
        if ($from[$this->getFatherField()] != 0) {
            $fatherFrom = $this->getNode($from[$this->getFatherField()]);
            $fatherFrom = $fatherFrom[0];
            $fatherFrom = get_object_vars($fatherFrom);
            if (count($bro) <= 1) {
                // la bandera haschild del padre se vuelve 0
                $fatherFrom[$this->getHasChild()] = 0;
            }
        }
        // bandera del nuevo padre a 1
        $to[$this->getHasChild()] = 1;
        DB::beginTransaction();
        try {
            if ($from[$this->getFatherField()] != 0) {
                DB::table($this->getTable())->where($this->getPk(), '=', $fatherFrom[$this->getPk()])->update($fatherFrom);
            }
            if ($toDependent != 0) {
                DB::table($this->getTable())->where($this->getPk(), '=', $to[$this->getPk()])->update($to);
            }
            foreach ($rIn as $i) {
                DB::table($this->getTable())->where($this->getPk(), '=', $i[$this->getPk()])->update($i);
            }
            // reindexamos rama del padre original
            // por la transaccion ya se movio la rama
            if ($from[$this->getFatherField()] != 0) {
                $inl = $this->reIndexTree($fatherFrom[$this->getPk()], $from[$this->getPk()]);
            } else {
                $inl = $this->reIndexTree('', $from[$this->getPk()]);
            }
            foreach ($inl as $i) {
                DB::table($this->getTable())->where($this->getPk(), '=', $i[$this->getPk()])->update($i);
            }
            DB::commit();
            $rest = ['success' => true, 'msg' => 'Registro actualizado y rama movida'];
        } catch (\Exception $e) {
            DB::rollBack();
            $rest = ['success' => false, 'msg' => 'No se pudo eliminar el registro ' . $e];
        }
        return $rest;
    }

    /**
     * Retorna un array con todos los nodos de una rama
     * @param $id // es el id del inicio de la rama si es vacio devuelve todo el arbol
     * @param string $idEx // es el id dentro de la rama que no queremos listar
     * @return mixed
     */
    public function getBranch($id = '', $idEx = '')
    {
        $t = $this->getNode($id);
        $t = $t[0];
        $t = get_object_vars($t);
        $r = DB::table($this->getTable())->where($this->getTree(), 'like', $t[$this->getTree()] . '%')->orderBy($this->getTree(), 'asc')->get()->toArray();
        return $r;
    }

    /**
     * Obtiene los hermanos de un nodo
     * @param $id
     * @return array
     */
    public function getBrothers($id)
    {
        $node = $this->getNode($id);
        $node = $node[0];
        $node = get_object_vars($node);
        $reg = DB::table($this->getTable())
            ->where($this->getFatherField(), '=', $node[$this->getFatherField()])
            ->orderBy($this->getTree(), 'asc')->get();
        return $reg;
    }

    /**
     * Metodo que devuelve una rama reindexada en un vector
     * @param $id // cualquier id del nivel a reindexar
     * @param $idEx // opcional si desea excluirse alguna rama del reindexado (eliminar)
     * @return array
     */
    public function reIndexTree($id = '', $idEx = '')
    {
        $rIndex = array();
        if ($id != '') {
            $toIndex = $this->getNode($id);
            $toIndex = $toIndex[0];
            $toIndex = get_object_vars($toIndex);
        } else {
            $toIndex = array();
        }
        if ($idEx != '') {
            $noIndex = $this->getNode($idEx);
            $noIndex = $noIndex[0];
            $noIndex = get_object_vars($noIndex);
        } else {
            $noIndex = array();
        }
        $h = DB::select(TreeSql::reIndexStatements($this, $toIndex, $noIndex));
        if ($h) {
            // 10.   Si: solo reindexamos los índices de sus hijos
            $i = 0;
            $j = 0;
            $in = array(); // indice de niveles
            $inl = array(); // prefijo padre
            $prev = array(); // nodo anterior
            foreach ($h as $v) {
                $v = get_object_vars($v);
                // init first iteration
                if ($i == 0) {
                    $j = $this->getLevelFromTree($v[$this->getLevel()]);
                    $in[$j] = 1;
                    // si es raiz
                    if ($v[$this->getLevel()] == 0) {
                        // si no es el inicio
                        if ($v[$this->getTree()] != '001') {
                            $inl[$j] = $v[$this->getTree()];
                        } else {
                            $inl[$j] = '001';
                            $v[$this->getTree()] = '001';
                        }
                    }
                    $prev = $v;
                    $i++;
                } else {
                    if ($prev[$this->getLevel()] == $v[$this->getLevel()]) {
                        // son hermanos
                        $in[$j]++;
                        $inl[$j] = substr($inl[$j], 0, -3) . $this->zeroFill($in[$j], $this->getLength());
                    } else {
                        if ($v[$this->getLevel()] > $prev[$this->getLevel()]) {
                            // profundiza la rama
                            $j++;
                            if (!isset($in[$j])) {
                                $in[$j] = 1;
                                $inl[$j] = $prev[$this->getTree()] . $this->getSeparator() . $this->zeroFill($in[$j], $this->getLength());
                            } else {
                                $in[$j]++;
                                $inl[$j] = substr($inl[$j], 0, -3) . $this->zeroFill($in[$j], $this->getLength());
                            }
                        } else {
                            for ($s = $prev[$this->getLevel()]; $s > ($v[$this->getLevel()]); $s--) {
                                unset($in[$s]);
                            }
                            // sube un nivel
                            $j = $j - ($prev[$this->getLevel()] - $v[$this->getLevel()]);
                            $in[$j]++;
                            $inl[$j] = substr($inl[$j], 0, -3) . $this->zeroFill($in[$j], $this->getLength());
                        }
                    }
                    // actualizamos el vector con el nuevo nodo
                    $v[$this->getTree()] = $inl[$j];
                    $prev = $v;
                }
                $rIndex[] = $v;
            }
        }
        return $rIndex;
    }

    /**
     * Elimina un nodo, reindexa y mantiene la integridad del arbol
     * @param $id
     * @return array
     */
    public function deleteNode($id)
    {
        $first = $this->getFirstNodeTree();
        $first = get_object_vars($first);
        if ($first[$this->getPk()] == $id) {
            $rest = ['success' => false, 'msg' => 'NO es posible eliminar el nodo padre de todo el arbol '];
        } else {
            // verificamos si el noto tiene hijos, sino solo el registro
            $node = $this->getNode($id);
            $node = $node[0];
            $node = get_object_vars($node);
            // si es o no es nodo raiz
            if ($node[$this->getFatherField()] != 0) {
                // verificamos si el padre tiene más hijos
                $nodeF = $this->getNode($node[$this->getFatherField()]);
                $nodeF = $nodeF[0];
                $nodeF = get_object_vars($nodeF);
                $regF = $this->getBranch($nodeF[$this->getPk()]);
                if (count($regF) > 2) {
                    // reindexamos los hijos
                    $rIn = $this->reIndexTree($nodeF[$this->getPk()], $node[$this->getPk()]);
                } else {
                    $rIn = array();
                    $nodeF[$this->getHasChild()] = 0;
                }
                // es raiz, obtenemos su rama si la tiene
                if ($node[$this->getHasChild()] == 1) {
                    $reg = $this->getBranch($id);
                }
            } else {
                // es raiz, obtenemos su rama si la tiene
                if ($node[$this->getHasChild()] == 1) {
                    $reg = $this->getBranch($id);
                }
                $rIn = $this->reIndexTree('', $node[$this->getPk()]);
            }
            DB::beginTransaction();
            try {
                if (isset($reg)) {
                    foreach ($reg as $v) {
                        $v = get_object_vars($v);
                        DB::table($this->getTable())->where($this->getPk(), $v[$this->getPk()])->delete();
                    }
                } else {
                    DB::table($this->getTable())->where($this->getPk(), $node[$this->getPk()])->delete();
                }
                foreach ($rIn as $i) {
                    DB::table($this->getTable())->where($this->getPk(), '=', $i[$this->getPk()])->update($i);
                }
                if (!empty($nodeF)) {
                    DB::table($this->getTable())->where($this->getPk(), '=', $nodeF[$this->getPk()])->update($nodeF);
                }
                DB::commit();
                $rest = ['success' => true, 'msg' => 'Registro y rama eliminada'];
            } catch (\Exception $e) {
                DB::rollBack();
                $rest = ['success' => false, 'msg' => 'No se pudo eliminar el registro ' . $e];
            }
        }
        return $rest;
    }

    public function changeOrder($id, $orders)
    {
        $res = $this->getBrothers($id);
        $upd = array();
        foreach ($res as $v) {
            $d = get_object_vars($v);
            $o = $orders['tree_' . $d[$this->getPk()]];
            $d[$this->getTree()] = substr($d[$this->getTree()], 0, -3) . $this->zeroFill($o, $this->getLength());
            $upd[] = $d;
        }
        DB::beginTransaction();
        try {
            foreach ($upd as $i) {
                DB::table($this->getTable())->where($this->getPk(), '=', $i[$this->getPk()])->update($i);
            }
            DB::commit();
            $rest = ['success' => true, 'msg' => 'Registro actualizado y rama movida'];
        } catch (\Exception $e) {
            DB::rollBack();
            $rest = ['success' => false, 'msg' => 'No se pudo eliminar el registro ' . $e];
        }
        return $rest;
    }

    /**
     * Retorna para sentencia SQL los nombres de los campos
     * @return string
     */
    private function getFieldStatement()
    {
        return $this->getPk() . ', ' .
            $this->getName() . ', ' .
            $this->getTree() . ', ' .
            $this->getLevel() . ', ' .
            $this->getHasChild() . ' ' .
            $this->getFatherField() . ' ';
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->Name;
    }
    /************************************************************/
    /******** ADD FUNCTIONS *************************************/
    /************************************************************/

    /**
     * @param mixed $Name
     */
    public function setName($Name)
    {
        $this->Name = $Name;
    }
}
