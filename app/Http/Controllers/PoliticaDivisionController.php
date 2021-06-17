<?php

namespace App\Http\Controllers;

use App\PoliticaDivision;
use App\SqlClasses\PoliticDivisionSql;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PhpClasses;


class PoliticaDivisionController extends Controller
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
    public function index(Request $request, PhpClasses\Tree $tree)
    {
        if ($request->ajax()) {
            $data = DB::select(PoliticDivisionSql::getList());
            return $data;
        }

        //para obtener los datos del tree
        $da = AdministradorController::menu($tree);

        return view('politicadivision.index', compact('da'));
        //return view('usuario.index');
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

        $unidad = $request->only(['pdv_name', 'pdv_locacion', 'pdv_estado']);

        DB::beginTransaction();
        try {
            $pdv_id = PoliticaDivision::insertGetId($unidad);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        if (isset($pdv_id)) {
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

        return response()->json($rest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PoliticaDivision  $politicaDivision
     * @return \Illuminate\Http\Response
     */
    public function show(PoliticaDivision $politicaDivision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PoliticaDivision  $politicaDivision
     * @return \Illuminate\Http\Response
     */
    public function edit(PoliticaDivision $politicaDivision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PoliticaDivision  $politicaDivision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pdv_id)
    {

        $datos = $request->all();
        DB::beginTransaction();
        try {
            PoliticaDivision::where('pdv_id', '=', $pdv_id)->update($datos);
            $rest = ['success' => true, 'msg' => 'Datos actualizados correctamente'];
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $rest = ['success' => false, 'msg' => 'no se actualizo los datos'];
        }
        return (json_encode($rest));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PoliticaDivision  $politicaDivision
     * @return \Illuminate\Http\Response
     */
    public function destroy($pdv_id)
    {
        DB::beginTransaction();
        try {
            PoliticaDivision::destroy($pdv_id);

            //elimando datos de perfil usuario
            //ModuloProfileUser::where('use_id', '=', $acc['use_id'])->delete();
            DB::commit();
            $rest = [
                'success' => true,
                'msg' => 'Eliminado correctamente'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            $rest = [
                'success' => false,
                'msg' => 'No se pudo eliminar el registro'
            ];
        }
        return (json_encode($rest));
    }
    public function comboBox($pdv_id = '')
    {
        $pol = PoliticaDivision::select('pdv_id as value', 'pdv_name as text')->where('pdv_estado', '=', 1)->get();
        return $pol;
    }
}
