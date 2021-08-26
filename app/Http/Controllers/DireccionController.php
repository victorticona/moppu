<?php

namespace App\Http\Controllers;

use App\Direccion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PhpClasses;
use App\PoliticaDivision;

class DireccionController extends Controller
{
    private $t;
    public function __construct(PhpClasses\Tree $tree)
    {
        $this->t = $tree;
        $this->t->setTable('direccion');
        $this->t->setPk('dir_id');
        $this->t->setFieldPrefix('dir_');
        $this->t->setName('dir_name');
        $this->t->setTree('dir_tree');
        $this->t->setLevel('dir_level');
        $this->t->setHasChild('dir_haschild');
        $this->t->setFieldName('dir_name');
        $this->t->setFatherField('dir_father');

        //no puede entrar si no esta logueado
        $this->middleware('auth');
        //$this->middleware('paraUrl')->only('create', 'index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PhpClasses\Tree $tree)
    {
        //
        if ($request->ajax()) {
            $data = $this->t->getAllForComboDir();
            return $data;
        }

        $da = AdministradorController::menu($tree);

        return view('direccion.index', compact('da'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // datos a insertar
        //dd($request->all());
        $data = $request->except('_token', 'dir_padre', 'dir_id', 'dir_desig');
        //d($data);
        $r = $this->t->insertNode($data);
        return response()->json($r);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function show(Direccion $direccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function edit(Direccion $direccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $mod_id)
    {
        //dd($request->all());
        $rIndex = array(); // para re-indexado
        // 0. Si le id es igual al del nuevo padre salta una excepción
        $mod = request()->except('_token', '_method', 'dir_padre', 'dir_desig');
        if (empty($request['dir_father'])) {
            $mod['dir_father'] = 0;
        }
        $rest = $this->t->updateNode($mod);
        return response()->json($rest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function destroy($dir_id)
    {
        $rIn = $this->t->deleteNode($dir_id);
        return (json_encode($rIn));
    }

    public function getdireccion($dir_id)
    {
        $dire = Direccion::where('dir_id', '=', $dir_id)->get()->toArray();
        $dire = $dire[0];
        $pad = Direccion::where('dir_id', '=', $dire['dir_father'])->get('dir_name')->toArray();
        if (!empty($pad)) {
            $dire['dir_padre'] = $pad[0]['dir_name'];
        } else {
            $dire['dir_padre'] = "";
        }
        $poldi = PoliticaDivision::where("pdv_id", "=", $dire["pdv_id"])->get('pdv_name')->toArray();
        $dire['dir_desig'] = $poldi[0]['pdv_name'];
        return json_encode($dire);
    }
}
