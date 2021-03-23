<?php

namespace App\Http\Controllers;

use App\Miperfil;
use App\SqlClasses\UserPersonSql;
use App\UserPerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PhpClasses;


class MiperfilController extends Controller
{
    public function __construct()
    {
        //no puede entrar si no esta logueado
        $this->middleware('auth');
        //$this->middleware('paraUrl')->except('edit', 'update', 'destroy', 'detail', 'Myperfil');
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
            $data = DB::select(UserPersonSql::getUser());
            return $data;
        }

        //para obtener los datos del tree
        $da = AdministradorController::menu($tree);

        // $id  = auth()->user()->id;
        // $id = UserPerson::where('id', $id)->get(['use_id']);
        // $id = $id[0]['use_id'];



        return view('miperfil.index', compact('da'));
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
     * @param  \App\Miperfil  $miperfil
     * @return \Illuminate\Http\Response
     */
    public function show(Miperfil $miperfil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Miperfil  $miperfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Miperfil $miperfil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Miperfil  $miperfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Miperfil $miperfil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Miperfil  $miperfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Miperfil $miperfil)
    {
        //
    }
}
