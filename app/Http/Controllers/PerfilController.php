<?php

namespace App\Http\Controllers;

use App\Modulo;
use App\ModuloProfile;
use App\ModuloProfileUser;
use App\Perfil;
use App\PhpClasses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(PhpClasses\Tree $tree)
    {
        $da = AdministradorController::menu($tree);

        return view('perfil.index', compact('da'));
    }
    public function indexList(Request $request)
    {
        $p = Perfil::all();
        return response()->json($p);
    }
    public function getModules($pro_id)
    {
        $ms = ModuloProfile::select('mod_id')->where('pro_id', '=', $pro_id)->get()->toArray();

        $a = array();
        foreach ($ms as $v) {
            $a[] =  ['id' => $v['mod_id']];
        }
        //return response()->json($a);
        return json_encode($a);
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
        $perf = $request->params['dato'];
        $perf['pro_name'] = strtoupper($perf['pro_name']);
        $mod = $request->params['select'];
        if (sizeof($mod) == 0) {
            $rest = [
                'success' => false,
                'msg' => 'Ingrese al menos un modulo'
            ];
        } else {
            DB::beginTransaction();
            try {
                $proId = Perfil::insertGetId($perf);
                for ($i = 0; $i < count($mod); $i++) {
                    $in = array('pro_id' => $proId, 'mod_id' => $mod[$i]['id']);
                    ModuloProfile::insert($in);
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
            }
            if (isset($proId)) {
                $rest = [
                    'success' => true,
                    'msg' => 'Datos registrados correctamente'
                ];
            } else {
                $rest = [
                    'success' => false,
                    'msg' => 'Datos no registrados, hubo un problema en el servidor'
                ];
            }
        }

        return $rest;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pro_id)
    {
        //
        $perf = $request->params['dato'];
        $perf['pro_name'] = strtoupper($perf['pro_name']);
        $mod = $request->params['select'];
        if (sizeof($mod) == 0) {
            $rest = [
                'success' => false,
                'msg' => 'Ingrese al menos un modulo'
            ];
        } else {
            DB::beginTransaction();
            try {
                Perfil::where('pro_id', '=', $pro_id)->update($perf);
                $per = ModuloProfileUser::select('use_id')->groupBy('use_id')->where('pro_id', '=', $pro_id)->get();
                ModuloProfile::where('pro_id', '=', $pro_id)->delete();
                ModuloProfileUser::where('pro_id', '=', $pro_id)->delete();
                foreach ($mod as $v) {
                    $in = array('pro_id' => $pro_id, 'mod_id' => $v['id']);
                    ModuloProfile::insert($in);
                    for ($i = 0; $i < sizeof($per); $i++) {
                        $ini = array('mod_id' => $v['id'], 'pro_id' => $pro_id,  'use_id' => $per[$i]['use_id']);
                        ModuloProfileUser::insert($ini);
                    }
                }
                $rest = [
                    'success' => true,
                    'msg' => 'Datos actualizados correctamente'
                ];
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $rest = [
                    'success' => false,
                    'msg' => 'Error al intentar registrar'
                ];
            }
        }

        return $rest;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy($pro_id)
    {
        //
        DB::beginTransaction();
        try {
            ModuloProfile::where('pro_id', '=', $pro_id)->delete();
            Perfil::where('pro_id', '=', $pro_id)->delete();
            ModuloProfileUser::where('pro_id', '=', $pro_id)->delete();
            $rest = [
                'success' => true,
                'msg' => 'Perfil eliminado correctamente'
            ];
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $rest = [
                'success' => false,
                'msg' => 'Error al intentar eliminar '
            ];
        }
        return (json_encode($rest));
    }
    public function comboBox($pro_id = '')
    {
        $pol = Perfil::select('pro_id as value', 'pro_name as text')->where('pro_state', '=', 1)->get();
        return $pol;
    }
}
