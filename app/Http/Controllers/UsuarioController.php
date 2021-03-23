<?php

namespace App\Http\Controllers;

use App\Access;
use App\ModuloProfile;
use App\ModuloProfileUser;
use App\Persona;
use App\PoliticaDivision;
use App\SqlClasses\UserPersonSql;
use App\User;
use App\UserPerson;
use App\Usuario;
use Faker\Provider\ar_JO\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\PhpClasses;

class UsuarioController extends Controller
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
            $data = DB::select(UserPersonSql::getList());
            return $data;
        }
        $da = AdministradorController::menu($tree);

        return view('usuario.index', compact('da'));
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

        //dd(sizeof($profi));
        //dd($request->all());
        $perf = ModuloProfile::where('pro_id', '=', $request['pro_id'])->get()->toArray();
        //dd($perf);
        $dataPerson = $request->only([
            'per_name', 'per_lastname', 'per_lastname2',
            'per_ci', 'pdv_id', 'per_date', 'per_phone', 'per_mobile', 'per_email', 'per_sex'
        ]);
        $dataPerson['per_is_usuario'] = 1;
        $dataUser = $request->only(['use_username', 'use_state']);
        $dataAccess = $request->only(['acc_value']);
        $dataAccess['acc_value'] = Hash::make($dataAccess['acc_value']);
        $dataAccess['acc_state'] = 1;
        $dataUsers['name'] = $dataUser['use_username'];
        $dataUsers['password'] = $dataAccess['acc_value'];
        $dataUsers['email'] = $dataPerson['per_email'];
        $dataUsers['created_at'] = \Carbon\Carbon::now();
        $dataUsers['updated_at'] = \Carbon\Carbon::now();
        if (PersonaController::ciExists($dataPerson['per_ci'])) {
            $rest = [
                'success' => false,
                'msg' => 'Ya existe una persona registrada con este carnet'
            ];
        } elseif (PersonaController::emailExists($dataPerson['per_email'])) {
            $rest = [
                'success' => false,
                'msg' => 'Ya existe este correo electronico registrado'
            ];
        } else {

            if ($request['acc_value'] == '' ||  strlen($request['acc_value']) < 8) {
                $rest = [
                    'success' => false,
                    'msg' => 'Tieno menor a 8 caracteres'
                ];
            } else {
                if (!filter_var($request['per_email'], FILTER_VALIDATE_EMAIL)) {
                    $rest = [
                        'success' => false,
                        'msg' => 'Correo no valido'
                    ];
                } else {
                    DB::beginTransaction();
                    try {
                        $usersId = User::insertGetId($dataUsers);
                        $perId = Persona::insertGetId($dataPerson);
                        $dataUser['per_id'] = $perId;
                        $dataUser['id'] = $usersId;
                        $useId = UserPerson::insertGetId($dataUser);
                        for ($i = 0; $i < sizeof($perf); $i++) {
                            $ini = array('mod_id' => $perf[$i]['mod_id'], 'pro_id' =>  $perf[$i]['pro_id'],  'use_id' => $useId);
                            ModuloProfileUser::insert($ini);
                        }
                        $dataAccess['use_id'] = $useId;
                        $accId = Access::insertGetId($dataAccess);
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollBack();
                    }
                    if (isset($useId)) {
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
            }
        }


        return response()->json($rest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $use_id)
    {
        $use = request()->only(['use_username', 'use_state']);
        $per = request()->only([
            'per_name', 'per_lastname', 'per_lastname2',
            'per_ci', 'pdv_id', 'per_date', 'per_phone', 'per_mobile', 'per_email', 'per_sex'
        ]);
        $users['name'] = $use['use_username'];
        $users['email'] = $per['per_email'];

        $perId = UserPerson::where('use_id', '=', $use_id)->value('per_id');
        $accId = Access::where('use_id', '=', $use_id)->value('acc_id');
        $usId = UserPerson::where('use_id', '=', $use_id)->value('id');

        if (PersonaController::ciAnotherExists($perId, $per['per_ci'])) {
            $rest = [
                'success' => false,
                'msg' => 'No puede asignar este carnet porque existe otro usuario registrado con esta cedula'
            ];
        } elseif (PersonaController::emailAnotherExists($perId, $per['per_email'])) {
            $rest = [
                'success' => false,
                'msg' => 'No puede asignar este email porque existe otro usuario registrado con este correo'
            ];
        } else {
            if (UserPersonController::UserNameAnotherExists($use_id, $request['use_username'])) {
                $rest = [
                    'success' => false,
                    'msg' => 'Ya existe este NICKNAME registrado'
                ];
            } else {
                if ($request['acc_value'] != $request['verifi_pass']) {
                    $rest = [
                        'success' => false,
                        'msg' => 'Tu nueva contraseña no coincide, verifique!'
                    ];
                } else {
                    $pass = Access::where('use_id', $use_id)->get(['acc_value']);
                    if ($request['acc_value'] != ''  && !Hash::check($request['ant_pass'], $pass[0]['acc_value'])) {
                        //if ($request['ant_pass'] != $pass[0]['acc_value']) {
                        $rest = [
                            'success' => false,
                            'msg' => 'tu contraseña que ingresaste es incorrecta'
                        ];
                    } else {

                        DB::beginTransaction();
                        try {
                            if ($request['acc_value'] != '') {
                                $acc['acc_value'] = Hash::make($request['acc_value']);
                                $users['password'] = $acc['acc_value'];
                                Access::where('acc_id', '=', $accId)->update($acc);
                            }

                            UserPerson::where('use_id', '=', $use_id)->update($use);
                            Persona::where('per_id', '=', $perId)->update($per);

                            User::where('id', '=', $usId)->update($users);
                            //elimando datos de perfil usuario
                            ModuloProfileUser::where('use_id', '=', $use_id)->delete();
                            $profi = ModuloProfile::where('pro_id', '=', $request['pro_id'])->get()->toArray();
                            for ($i = 0; $i < sizeof($profi); $i++) {
                                $ini = array('mod_id' => $profi[$i]['mod_id'], 'pro_id' =>  $profi[$i]['pro_id'],  'use_id' => $use_id);
                                ModuloProfileUser::insert($ini);
                            }

                            $rest = ['success' => true, 'msg' => 'Datos actualizados correctamente'];
                            DB::commit();
                        } catch (\Exception $e) {
                            DB::rollBack();
                            $rest = ['success' => false, 'msg' => 'no se actualizo los datos'];
                        }
                    }
                }
            }
        }
        return (json_encode($rest));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($acc_id)
    {
        //dd($acc_id);
        //
        $acc = Access::find($acc_id);
        $use = UserPerson::find($acc['use_id']);

        DB::beginTransaction();
        try {
            UserPerson::destroy($acc['use_id']);
            Persona::destroy($use['per_id']);

            Access::destroy($acc_id);
            User::destroy($use['id']);
            //elimando datos de perfil usuario
            ModuloProfileUser::where('use_id', '=', $acc['use_id'])->delete();
            DB::commit();
            $rest = ['success' => true, 'msg' => 'Usuario eliminado correctamente'];
        } catch (\Exception $e) {
            DB::rollBack();
            $rest = [
                'success' => false,
                'msg' => 'No se pudo eliminar el registro'
            ];
        }
        return (json_encode($rest));
    }
    public function Perfil($use_id)
    {
        $dato = ModuloProfileUser::select('pro_id')->groupBy('pro_id')->where('use_id', '=', $use_id)->get();
        return $dato[0]['pro_id'];
    }
}
