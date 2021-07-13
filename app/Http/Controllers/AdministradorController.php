<?php

namespace App\Http\Controllers;

use App\Administrador;
use App\Modulo;
use App\ModuloProfileUser;
use Illuminate\Http\Request;
use App\PhpClasses;
use App\UserPerson;

class AdministradorController extends Controller
{
    private $t;
    public function __construct(PhpClasses\Tree $tree)
    {

        $this->t = $tree;
        $this->t->setTable('module');
        $this->t->setPk('mod_id');
        $this->t->setFieldPrefix('mod_');
        $this->t->setName('mod_name');
        $this->t->setTree('mod_tree');
        $this->t->setLevel('mod_level');
        $this->t->setHasChild('mod_haschild');
        $this->t->setFieldName('mod_name');
        $this->t->setFatherField('mod_father');
        //no puede entrar si no esta logueado
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        //dd(session('__use_id'));
        $da = $this->t->getAll();

        $idU = auth()->user()->id;
        $use = UserPerson::where('id', '=', $idU)->get()->toArray();
        $mod = ModuloProfileUser::where('use_id', '=', $use[0]['use_id'])->get()->toArray();
        $menu[] = null;
        for ($i = 0; $i < sizeof($mod); $i++) {
            for ($j = 0; $j < sizeof($da['rows']); $j++) {
                if ($mod[$i]['mod_id'] == $da['rows'][$j]['mod_id']) {
                    $menu[$i] = $da['rows'][$j];
                }
            }
        }
        $extra = $menu;
        $c = sizeof($menu);

        for ($i = 0; $i < sizeof($extra); $i++) {
            for ($j = 0; $j < sizeof($da['rows']); $j++) {
                if ($extra[$i]['mod_father'] == $da['rows'][$j]['mod_id']) {
                    $menu[$c] = $da['rows'][$j];
                    $c++;
                }
            }
        }


        $num = sizeof($menu);
        for ($i = 0; $i < $num - 1; $i++) {
            for ($j = $i + 1; $j < $num; $j++) {
                if ($menu[$i]['mod_id'] == $menu[$j]['mod_id'] && $i != $j) {
                    if ($j != ($num - 1)) {
                        for ($k = $j; $k < $num - 1; $k++) {
                            $menu[$k] = $menu[$k + 1];
                        }
                    }
                    unset($menu[$num - 1]);
                    $num--;
                    $j--;
                }
            }
        }
        $people = $menu;
        foreach ($people as $person) {
            foreach ($person as $key => $value) {
                if (!isset($sortArray[$key])) {
                    $sortArray[$key] = array();
                }
                $sortArray[$key][] = $value;
            }
        }

        //dd($da);
        $orderby = "mod_tree"; //change this to whatever key you want from the array

        array_multisort($sortArray[$orderby], SORT_ASC, $people);

        $da = $people;



        $url = substr(url()->current(), strlen(url('/') . "/"), strlen(url()->current()));
        $nom = Modulo::where('mod_url', '=', $url)->get()->toArray();
        $da[0]['nombre'] = $nom[0]['mod_name'];

        //dd($da);
        return view('admin.index', compact('da'));
    }
    public static function  menu(PhpClasses\Tree $tree)
    {
        $ta = $tree;
        $ta->setTable('module');
        $ta->setTree('mod_tree');
        $ta->setHasChild('mod_haschild');
        $ta->setFieldName('mod_name');
        $ta->setFatherField('mod_father');
        $da = $ta->getAll();

        $idU = auth()->user()->id;
        $use = UserPerson::where('id', '=', $idU)->get()->toArray();
        $mod = ModuloProfileUser::where('use_id', '=', $use[0]['use_id'])->get()->toArray();
        $menu[] = null;
        for ($i = 0; $i < sizeof($mod); $i++) {
            for ($j = 0; $j < sizeof($da['rows']); $j++) {
                if ($mod[$i]['mod_id'] == $da['rows'][$j]['mod_id']) {
                    $menu[$i] = $da['rows'][$j];
                }
            }
        }
        $extra = $menu;

        $c = sizeof($menu);
        for ($i = 0; $i < sizeof($extra); $i++) {
            for ($j = 0; $j < sizeof($da['rows']); $j++) {
                if ($extra[$i]['mod_father'] == $da['rows'][$j]['mod_id']) {
                    $menu[$c] = $da['rows'][$j];
                    $c++;
                }
            }
        }


        $num = sizeof($menu);
        for ($i = 0; $i < $num - 1; $i++) {
            for ($j = $i + 1; $j < $num; $j++) {
                if ($menu[$i]['mod_id'] == $menu[$j]['mod_id'] && $i != $j) {
                    if ($j != ($num - 1)) {
                        for ($k = $j; $k < $num - 1; $k++) {
                            $menu[$k] = $menu[$k + 1];
                        }
                    }
                    unset($menu[$num - 1]);
                    $num--;
                    $j--;
                }
            }
        }
        $people = $menu;
        foreach ($people as $person) {
            foreach ($person as $key => $value) {
                if (!isset($sortArray[$key])) {
                    $sortArray[$key] = array();
                }
                $sortArray[$key][] = $value;
            }
        }

        //dd($da);
        $orderby = "mod_tree"; //change this to whatever key you want from the array

        array_multisort($sortArray[$orderby], SORT_ASC, $people);

        $da = $people;

        $url = substr(url()->current(), strlen(url('/') . "/"), strlen(url()->current()));
        $nom = Modulo::where('mod_url', '=', $url)->get()->toArray();
        $da[0]['nombre'] = $nom[0]['mod_name'];
        //dd($da);


        return $da;
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
     * @param  \App\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function show(Administrador $administrador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function edit(Administrador $administrador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Administrador $administrador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Administrador $administrador)
    {
        //
    }
}
