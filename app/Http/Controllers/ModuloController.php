<?php

namespace App\Http\Controllers;

use App\Modulo;
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
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = $this->t->getAll();
            return json_encode($data);
        }
        return view('modulo.index');
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
        //
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
    public function update(Request $request, Modulo $modulo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modulo $modulo)
    {
        //
    }
    public function combobox($mod_id = '')
    {
        $d = $this->t->getAllForCombo();

        return $d;
    }
}
