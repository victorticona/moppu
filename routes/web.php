<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdministradorController@index')->name('admin')->middleware('auth');;

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/usuario/perfil/{use_id?}', 'UsuarioController@Perfil');
Route::get('/usuario/direccion/{use_id?}', 'UsuarioController@Direccion');
Route::resource('/usuario', 'UsuarioController');


Route::get('/polidivi/combobox/{pdv_id?}', 'PoliticaDivisionController@comboBox');
Route::resource('/polidivi', 'PoliticaDivisionController');

Route::get('/perfil/indexlist', 'PerfilController@indexList');
Route::get('/perfil/getmodules/{pro_id?}', 'PerfilController@getModules');
Route::get('/perfil/combobox/{pro_id?}', 'PerfilController@comboBox');
Route::resource('/perfil', 'PerfilController');

Route::get('/modulo/combobox/{mod_id?}', 'ModuloController@comboBox');
Route::get('/modulo/getmodulos/{mod_id?}', 'ModuloController@getModulos');
Route::resource('/modulo', 'ModuloController');

Route::resource('/miperfil', 'MiperfilController');


Route::resource('/direccion', 'direccionController');
Route::get('/direccion/getdireccion/{dir_id?}', 'DireccionController@getdireccion');
