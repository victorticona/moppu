<?php

namespace App\Http\Controllers;

use App\Modulo;
use App\ModuloProfile;
use App\ModuloProfileUser;
use Illuminate\Http\Request;
use App\PhpClasses;

class ModuloController extends Controller
{
    private $t;
    public function __construct(PhpClasses\Tree $tree)
    {
        $this->t = $tree;
        $this->t->setTable('module');
        $this->t->setPk('mod_id');
        $this->t->setFieldPrefix('mod_');
        $this->t->setName('mod_name');
        $this->t->setTree('mod_tree');
        $this->t->setLevel('mod_level');
        $this->t->setHasChild('mod_haschild');
        $this->t->setFieldName('mod_name');
        $this->t->setFatherField('mod_father');

        //no puede entrar si no esta logueado
        $this->middleware('auth');
        //$this->middleware('paraUrl')->only('create', 'index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {

    //     if ($request->ajax()) {
    //         $data = $this->t->getAll();
    //         return json_encode($data);
    //     }
    //     return view('modulo.index');
    // }
    public function index(Request $request, PhpClasses\Tree $tree)
    {
        //
        if ($request->ajax()) {
            $data = $this->t->getAllForCombo();
            return $data;
        }

        $da = AdministradorController::menu($tree);

        return view('modulo.index', compact('da'));
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
        $data = $request->except('_token', 'mod_padre', 'mod_id');
        //dd($request->all());
        $r = $this->t->insertNode($data);
        return response()->json($r);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function show(Modulo $modulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Modulo $modulo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $mod_id)
    {
        //dd($request->all());
        $rIndex = array(); // para re-indexado
        // 0. Si le id es igual al del nuevo padre salta una excepción
        $mod = request()->except('_token', '_method', 'mod_padre');

        $rest = $this->t->updateNode($mod);
        return response()->json($rest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function destroy($mod_id)
    {
        $rIn = $this->t->deleteNode($mod_id);
        ModuloProfile::where('mod_id', '=', $mod_id)->delete();
        ModuloProfileUser::where('mod_id', '=', $mod_id)->delete();
        return (json_encode($rIn));
    }
    public function combobox($mod_id = '')
    {
        $d = $this->t->getAllForCombo();
        //dd($d);
        return $d;
    }
    public function getModulos($mod_id)
    {
        $modulo = Modulo::where('mod_id', '=', $mod_id)->get()->toArray();
        $modulo = $modulo[0];
        $pad = Modulo::where('mod_id', '=', $modulo['mod_father'])->get('mod_name')->toArray();
        if (!empty($pad)) {
            $modulo['mod_padre'] = $pad[0]['mod_name'];
        } else {
            $modulo['mod_padre'] = "";
        }
        return json_encode($modulo);
    }
}
