<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public static function emailExists($email)
    {
        if ($email != '') {
            $r = Persona::where('per_email', '=', $email)->get();
            if ($r->isEmpty()) return false;
            else return true;
        }
        return false;
    }

    public static function ciExists($ci)
    {
        $r = Persona::where('per_ci', '=', $ci)->get();
        if ($r->isEmpty()) return false;
        else return true;
    }

    public static function nitExists($nit)
    {
        $r = Persona::where('per_nit', '=', $nit)->get();
        if ($r->isEmpty()) return false;
        else return true;
    }

    public static function ciAnotherExists($perId, $ci)
    {
        $r = Persona::where('per_ci', '=', $ci)
            ->where('per_id', '<>', $perId)->get();
        if ($r->isEmpty()) return false;
        else return true;
    }

    public static function emailAnotherExists($perId, $email)
    {
        if ($email != '') {
            $r = Persona::where('per_email', '=', $email)
                ->where('per_id', '<>', $perId)->get();
            if ($r->isEmpty()) return false;
            else return true;
        }
        return false;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        //
    }
}
