<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Persona;
use App\Providers\RouteServiceProvider;
use App\UserPerson;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login()
    {
        $cred = $this->validate(request(), [
            'name' => 'required|string',
            'password' => 'required|string'
        ]);
        if (Auth::attempt($cred)) {

            $id = auth()->user()->id;
            $idU = auth()->user()->id;
            $us = UserPerson::where('id', $id)->get(['use_state']);

            $id = UserPerson::where('id', $idU)->get(['per_id', 'use_id']);
            $per = Persona::where('per_id', $id[0]['per_id'])->get();
            session(['use_id' => $id[0]['use_id']]);
            session(['per_id' => $per[0]['per_id']]);
            session(['per_name' => $per[0]['per_name']]);
            session(['per_lastname' => $per[0]['per_lastname']]);


            if ($us[0]['use_state'] == 1) {
                return redirect('/admin');
            } else {
                Auth::logout();
                return back()->withErrors(['name' => 'El Usuario esta Inactivo', 'password' => '']);
            }
        } else {
            Auth::logout();
            return back()->withErrors(['name' => 'Error de Usuario', 'password' => 'Error de Contraseña']);
        }
    }

    public function logout()
    {
        session()->forget('per_name');
        session()->forget('per_lastname');
        session()->forget('use_id');
        session()->forget('per_id');


        Auth::logout();
        return redirect('/login');
    }
}
