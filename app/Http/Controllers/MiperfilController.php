<?php

namespace App\Http\Controllers;

use App\Access;
use App\Miperfil;
use App\Persona;
use App\SqlClasses\UserPersonSql;
use App\UserPerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PhpClasses;
use App\User;
use Illuminate\Support\Facades\Hash;


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


    public function update(Request $request)
    {
        //dd($request->all());
        //dd(session('use_id'));
        $use_id = session('use_id');
        $pass = Access::where('use_id', $use_id)->get(['acc_value']);
        if (!Hash::check($request['acc_value_ant'], $pass[0]['acc_value'])) {
            $rest = [
                'success' => false,
                'msg' => 'Ingresa tu contraseña actual para editar',
                'id' => 'acc_value_ant'
            ];
        } else {
            if ($request['per_name'] == '') {
                $rest = [
                    'success' => false,
                    'msg' => 'El "nombre" no puede ir vacio',
                    'id' => 'per_name'
                ];
            } else {
                if ($request['per_lastname'] == '') {
                    $rest = [
                        'success' => false,
                        'msg' => 'El "apellido" no puede ir vacio',
                        'id' => 'per_lastname'
                    ];
                } else {
                    if ($request['per_ci'] == '') {
                        $rest = [
                            'success' => false,
                            'msg' => 'Cedula de identidad no puede ir vacio',
                            'id' => 'per_ci'
                        ];
                    } else {
                        if ($request['per_mobile'] == '') {
                            $rest = [
                                'success' => false,
                                'msg' => 'El numero de celular no puede ir vacio',
                                'id' => 'per_mobile'
                            ];
                        } else {
                            if ($request['per_email'] == '') {
                                $rest = [
                                    'success' => false,
                                    'msg' => 'El "Email" no puede ir vacio',
                                    'id' => 'per_email'
                                ];
                            } else {
                                if ($request['use_username'] == '') {
                                    $rest = [
                                        'success' => false,
                                        'msg' => 'El "Nickname" no puede ir vacio',
                                        'id' => 'use_username'
                                    ];
                                } else {
                                    if ($request['acc_value_ant'] == '') {
                                        $rest = [
                                            'success' => false,
                                            'msg' => 'Introduzca su contraseña actual',
                                            'id' => 'acc_value_ant'
                                        ];
                                    } else {
                                        if ($request['acc_value'] != '' && $request['acc_value'] != $request['acc_value2']) {
                                            $rest = [
                                                'success' => false,
                                                'msg' => 'Si desea cambiar la contraseña, verifique si son iguales',
                                                'id' => 'acc_value2'
                                            ];
                                        } else {
                                            if (UserPersonController::UserNameAnotherExists($use_id, $request['use_username'])) {
                                                $rest = [
                                                    'success' => false,
                                                    'msg' => 'Ya existe este NICKNAME registrado',
                                                    'id' => 'use_username'
                                                ];
                                            } else {
                                                $perId = UserPerson::where('use_id', '=', $use_id)->value('per_id');
                                                if (PersonaController::ciAnotherExists($perId, $request['per_ci'])) {
                                                    $rest = [
                                                        'success' => false,
                                                        'msg' => 'No puede asignar este carnet, porque existe otro usuario registrado con esta cedula',
                                                        'id' => 'per_ci'
                                                    ];
                                                } else {
                                                    if (PersonaController::emailAnotherExists($perId, $request['per_email'])) {
                                                        $rest = [
                                                            'success' => false,
                                                            'msg' => 'No puede asignar este email, porque existe otro usuario registrado con este correo',
                                                            'id' => 'per_email'
                                                        ];
                                                    } else {
                                                        if (PersonaController::mobileAnotherExists($perId, $request['per_mobile'])) {
                                                            $rest = [
                                                                'success' => false,
                                                                'msg' => 'No puede asignar este numero de celular, porque existe otro usuario registrado con este numero',
                                                                'id' => 'per_mobile'
                                                            ];
                                                        } else {
                                                            if (!filter_var($request['per_email'], FILTER_VALIDATE_EMAIL)) {
                                                                $rest = [
                                                                    'success' => false,
                                                                    'msg' => 'Correo no valido',
                                                                    'id' => 'per_email'
                                                                ];
                                                            } else {
                                                                DB::beginTransaction();
                                                                $per = request()->only([
                                                                    'per_name', 'per_lastname', 'per_lastname2',
                                                                    'per_ci', 'dir_id', 'per_date', 'per_phone', 'per_mobile', 'per_email', 'per_sex'
                                                                ]);
                                                                $user = request()->only(['use_username']);
                                                                $users['name'] = $request['use_username'];
                                                                $users['email'] = $request['per_email'];
                                                                $users_id = UserPerson::where('use_id', '=', $use_id)->value('id');
                                                                $acc_id = Access::where('use_id', '=', $use_id)->value('acc_id');
                                                                try {

                                                                    UserPerson::where('use_id', '=', $use_id)->update($user);
                                                                    Persona::where('per_id', '=', $perId)->update($per);

                                                                    if ($request['acc_value'] != '' && $request['acc_value2'] != '' && $request['acc_value'] == $request['acc_value2']) {
                                                                        $request['acc_value'] = Hash::make($request['acc_value']);
                                                                        $users['password'] = $request['acc_value'];
                                                                        $acc['acc_value'] = $request['acc_value'];
                                                                        $acc['acc_date_login'] = \Carbon\Carbon::now();
                                                                        Access::where('acc_id', '=', $acc_id)->update($acc);
                                                                    }
                                                                    User::where('id', '=', $users_id)->update($users);

                                                                    $rest = [
                                                                        'success' => true,
                                                                        'msg' => 'Datos actualizados correctamente'

                                                                    ];
                                                                    DB::commit();
                                                                } catch (\Exception $e) {
                                                                    DB::rollBack();
                                                                    $rest = [
                                                                        'success' => false,
                                                                        'msg' => 'no se actualizo los datos',
                                                                        'id' => $e
                                                                    ];
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return (json_encode($rest));
    }
}
