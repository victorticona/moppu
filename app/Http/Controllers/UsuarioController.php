<?php

namespace App\Http\Controllers;

use App\Access;
use App\Direccion;
use App\ModuloProfile;
use App\ModuloProfileUser;
use App\Perfil;
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
use Symfony\Component\HttpKernel\Profiler\Profile;

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

        //dd(auth()->user()->id);
        dd(\Carbon\Carbon::now());

        if (PersonaController::ciExists($request['per_ci'])) {
            $rest = [
                'success' => false,
                'msg' => 'Ya existe una persona registrada con este carnet',
                'id' => 'per_ci'
            ];
        } elseif (PersonaController::emailExists($request['per_email'])) {
            $rest = [
                'success' => false,
                'msg' => 'Ya existe este correo electronico registrado',
                'id' => 'per_email'
            ];
        } else {

            if ($request['acc_value'] == '' ||  strlen($request['acc_value']) < 8) {
                $rest = [
                    'success' => false,
                    'msg' => 'Tiene menor a 8 caracteres',
                    'id' => 'acc_value'
                ];
            } else {
                if (!filter_var($request['per_email'], FILTER_VALIDATE_EMAIL)) {
                    $rest = [
                        'success' => false,
                        'msg' => 'Correo no valido',
                        'id' => 'per_email'
                    ];
                } else {
                    if (UserPersonController::UserExists($request['use_username'])) {
                        $rest = [
                            'success' => false,
                            'msg' => 'Ya existe este NickName registrado',
                            'id' => 'use_username'
                        ];
                    } else {
                        //dd($request->all());
                        $perf = ModuloProfile::where('pro_id', '=', $request['pro_id'])->get()->toArray();
                        $dataPerson = $request->only([
                            'per_name', 'per_lastname', 'per_lastname2',
                            'per_ci', 'dir_id', 'per_date', 'per_phone', 'per_mobile', 'per_email', 'per_sex', 'per_dirdetalle'
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
                        //dd($dataPerson);
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
                        if (isset($perId)) {
                            $rest = [
                                'success' => true,
                                'msg' => 'Datos registrados correctamente',
                                'id' => $perId
                            ];
                        } else {
                            $rest = [
                                'success' => false,
                                'msg' => 'Datos no registrados, hubo un problema en el servidor',
                                'id' => $perId
                            ];
                        }
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
        //dd($request->all());
        $use = request()->only(['use_username', 'use_state']);
        $per = request()->only([
            'per_name', 'per_lastname', 'per_lastname2',
            'per_ci', 'dir_id', 'per_date', 'per_phone', 'per_mobile', 'per_email', 'per_sex', 'per_dirdetalle'
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
                if (!filter_var($request['per_email'], FILTER_VALIDATE_EMAIL)) {
                    $rest = [
                        'success' => false,
                        'msg' => 'Correo no valido',
                        'id' => 'per_email'
                    ];
                } else {
                    if ($request['acc_value'] != '' &&  strlen($request['acc_value']) < 8) {
                        $rest = [
                            'success' => false,
                            'msg' => 'Tiene menor a 8 caracteres',
                            'id' => 'acc_value'
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
                            $rest = ['success' => false, 'msg' => 'no se actualizo los datos, hubo un problema en el servidor'];
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
    public function destroy($use_id)
    {
        //dd($acc_id);
        $use = UserPerson::find($use_id);
        $acc = Access::where('use_id', '=', $use_id)->get();
        DB::beginTransaction();
        try {
            UserPerson::destroy($use_id);
            Persona::destroy($use['per_id']);

            Access::destroy($acc[0]->acc_id);
            User::destroy($use['id']);
            //elimando datos de perfil usuario
            ModuloProfileUser::where('use_id', '=', $use_id)->delete();
            DB::commit();
            $rest = [
                'success' => true,
                'msg' => 'Usuario eliminado correctamente'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            $rest = [
                'success' => false,
                'msg' => 'No se pudo eliminar el registro, hubo un problema en el servidor'
            ];
        }
        return (json_encode($rest));
    }
    public function Perfil($use_id)
    {
        $dato = ModuloProfileUser::select('pro_id')->groupBy('pro_id')->where('use_id', '=', $use_id)->get();
        $prof = Perfil::where('pro_id', '=', $dato[0]['pro_id'])->get()->toArray();
        $prof = $prof[0];
        return $prof;
    }

    public function Direccion($use_id)
    {
        $per = UserPerson::select('per_id')->where('use_id', '=', $use_id)->get()->toArray();
        $dir = Persona::select('dir_id', 'per_dirdetalle')->where('per_id', '=', $per[0]['per_id'])->get()->toArray();
        $dir = $dir[0]['dir_id'];
        $sw = $dir;
        $texto = '';
        while ($dir != 0) {
            $di = Direccion::select('dir_id', 'dir_name', 'dir_father', 'pdv_id')->where('dir_id', '=', $dir)->get()->toArray();
            $pol = PoliticaDivision::select('pdv_name')->where('pdv_id', '=', $di[0]['pdv_id'])->get()->toArray();
            if ($di[0]['dir_id'] != $sw) {
                $texto = $pol[0]['pdv_name'] . ": " . $di[0]['dir_name'] . ", " . $texto;
            } else {
                $texto = $pol[0]['pdv_name'] . ": " . $di[0]['dir_name']  . "\n" . $texto;
            }
            $dir = $di[0]['dir_father'];
        }
        //dd($texto);
        return $texto;
    }
}
