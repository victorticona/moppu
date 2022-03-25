<?php

namespace App\Http\Controllers;

use App\Anuncio;
use App\Direccion;
use App\Http\Controllers\Controller;
use App\Persona;
use App\PhpClasses;
use App\PoliticaDivision;
use App\SqlClasses\AnuncioSql;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnuncioController extends Controller
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
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        if ($request->ajax()) {
            $data = DB::select(AnuncioSql::getList());
            foreach ($data as $key => $value) {
                $dia = date('d', strtotime($value->anu_para_fec));
                $mes = date('m', strtotime($value->anu_para_fec));
                $mes = $meses[$mes - 1];
                $value->anu_para_fec = $dia . " de " . $mes;
                $dir = $value->dir_id;
                $value->direccion = AnuncioController::dirfull($dir);
            }
            return $data;
        }
        $da = AdministradorController::menu($tree);

        return view('anuncio.index', compact('da'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function show(Anuncio $anuncio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function edit(Anuncio $anuncio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anuncio $anuncio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anuncio $anuncio)
    {
        //
    }

    public function comboBox($pol)
    {
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        $dirid = session('dir_id');
        do {
            $fat = Direccion::where('dir_id', '=', $dirid)->get();
            $dirid = $fat[0]['dir_father'];
        } while ($pol != $fat[0]['pdv_id'] && $dirid != 0);

        if ($pol == $fat[0]['pdv_id']) {
            $anu = Anuncio::where('per_id', '!=', session('per_id'))
                ->where('anu_estado', '=', 1)->get();
            $anuncio = array();
            $c = 0;

            foreach ($anu as $key => $value) {
                $perid = $value->per_id;
                $person = Persona::where('per_id', '=', $perid)->get();
                $dirper = Direccion::where('dir_id', '=', $person[0]['dir_id'])->get();
                $polper = PoliticaDivision::where('pdv_id', '=', $dirper[0]['pdv_id'])->get();
                $dirid = $person[0]['dir_id'];
                $sw = 0;
                while ($sw == 0 && $dirid != 0) {
                    $pad = Direccion::where('dir_id', '=', $dirid)->get();
                    $dirid = $pad[0]['dir_father'];
                    if ($pad[0]['dir_id'] == $fat[0]['dir_id']) {
                        $anuncio[$c] = $value;
                        $anuncio[$c]['dir_id'] = $dirper[0]['dir_id'];
                        $anuncio[$c]['dir_name'] = $dirper[0]['dir_name'];
                        $anuncio[$c]['pdv_id'] = $polper[0]['pdv_id'];
                        $anuncio[$c]['pdv_name'] = $polper[0]['pdv_name'];
                        $anuncio[$c]['per_name'] = $person[0]['per_name'];
                        $anuncio[$c]['per_lastname'] = $person[0]['per_lastname'];
                        $anuncio[$c]['direccion'] = AnuncioController::dirfull($dirper[0]['dir_id']);
                        $dia = date('d', strtotime($value->anu_para_fec));
                        $mes = date('m', strtotime($value->anu_para_fec));
                        $mes = $meses[$mes - 1];
                        $value->anu_para_fec = $dia . " de " . $mes;
                        $c++;
                        $sw = 1;

                    }
                }
            }
        } else {
            $anuncio = null;

        }
        return $anuncio;
    }
    public function direccion($pol)
    {
        $dirid = session('dir_id');
        $cad = "";
        do {
            $fat = Direccion::where('dir_id', '=', $dirid)->get();
            $dirid = $fat[0]['dir_father'];
        } while ($pol != $fat[0]['pdv_id'] && $dirid != 0);

        if ($pol == $fat[0]['pdv_id']) {
            $poli = PoliticaDivision::where('pdv_id', '=', $pol)->get();
            $di = $fat[0]['dir_name'];
            $cad = $poli[0]['pdv_name'] . " " . $di;
        }
        return $cad;
    }
    public static function dirfull($dir)
    {
        $sw = $dir;
        $texto = '';
        while ($dir != 0) {
            $di = Direccion::select('dir_id', 'dir_name', 'dir_father', 'pdv_id')->where('dir_id', '=', $dir)->get()->toArray();
            $pol = PoliticaDivision::select('pdv_name')->where('pdv_id', '=', $di[0]['pdv_id'])->get()->toArray();
            if ($di[0]['dir_id'] != $sw) {
                $texto = $pol[0]['pdv_name'] . ": " . $di[0]['dir_name'] . ", \n" . $texto;
            } else {
                $texto = $pol[0]['pdv_name'] . ": " . $di[0]['dir_name'] . $texto;
            }
            $dir = $di[0]['dir_father'];
        }
        return $texto;
    }
    public function MyPedido($pol='')
    {
        $perid = session('per_id');
        $anuncio = Anuncio::where('per_id', '=', $perid)->get();
        return $anuncio;
    }
}
