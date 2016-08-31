<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * Home controller routes
 */
Route::get('/', 'HomeController@dashboard');
Route::get('/home', 'HomeController@index');
/**
 * Authorization routes
 */
Route::auth();
/**
 * User Configuration Routes
 */
Route::get('/change-password', 'UserController@changePassword');
Route::post('/change-password', 'UserController@postChangePassword');
Route::get('/register', 'UserController@register');
Route::get('/users', 'UserController@getUsers');

/**
 * Cotizacion Routes
 */

 Route::get('servicios-cotizacion-rapida','CotizacionController@getServicios');
 Route::get('sizes-cotizacion-rapida','CotizacionController@getSizes');
 Route::get('colores-cotizacion-rapida','CotizacionController@getColors');
 Route::get('cotizacion-rapida','CotizacionController@getCotizacion');
 Route::post('step-2','CotizacionController@postServicios');
 Route::post('step-4','CotizacionController@postSizes');
 Route::post('step-5','CotizacionController@postColors');

 /**
  * Clientes
  */
 Route::get('clientes/autocomplete', 'ClientesController@autocomplete');
 Route::get('clientes/create', 'ClientesController@createCliente');
 Route::post('clientes/store', 'ClientesController@store');
 Route::post('clientes/ver-cliente','ClientesController@getCliente');
 Route::post('/cliente/update/{id}', 'ClientesController@updateCliente');

 /**
  * Notas
  */
 Route::get('/notas/create', 'NotasController@createNota');
 Route::post('/notas/store', 'NotasController@storeNota');
 Route::get('/notas/show/{id}', 'NotasController@showNota');
 Route::post('/notas/cerrar/{id}','NotasController@cerrarNota');


 /**
  *Caja
  */
 Route::get('/caja', 'TransactionsController@caja');
 Route::get('/retiro', 'TransactionsController@retiro');
 Route::post('/retiro', 'TransactionsController@retirar');
 Route::get('/cerrar-caja', 'TransactionsController@cerrarCaja');