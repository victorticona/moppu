<?php

namespace App\Http\Controllers;

use App\UserPerson;
use Illuminate\Http\Request;

class UserPersonController extends Controller
{
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
     * @param  \App\UserPerson  $userPerson
     * @return \Illuminate\Http\Response
     */
    public function show(UserPerson $userPerson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserPerson  $userPerson
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPerson $userPerson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserPerson  $userPerson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserPerson $userPerson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserPerson  $userPerson
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPerson $userPerson)
    {
        //
    }
    public static function UserNameAnotherExists($useId, $nickname)
    {
        if ($nickname != '') {
            $r = UserPerson::where('use_username', '=', $nickname)
                ->where('use_id', '<>', $useId)->get();
            if ($r->isEmpty()) return false;
            else return true;
        }
        return false;
    }
    public static function UserExists($username)
    {
        $r = UserPerson::where('use_username', '=', $username)->get();
        if ($r->isEmpty()) return false;
        else return true;
    }
}
