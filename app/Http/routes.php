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

Route::get('/', function () {
    return view('layouts.master');

});



    Route::group(['prefix'=>'productos'],function(){
    Route::get('/',           'ProductosController@index');
    Route::get('/listar',     'ProductosController@listar');
    Route::get('/edit/{id}',  'ProductosController@edit');
    Route::get('/add',         'ProductosController@create');
    Route::post('/create',     'ProductosController@store');
    Route::post('/update/{id}','ProductosController@update');
    Route::get('/delete/{id}', 'ProductosController@destroy');
    Route::get('/mostrarArchivo/{archivo}', 'ProductosController@mostrarArchivo');
    Route::get('/deshabilitar/{id}', 'ProductosController@deshabilitar');
    Route::get('/habilitar/{id}', 'ProductosController@deshabilitar');
    Route::get('/autocompletar', array('uses'=>'ProductosController@autocompletar'));


     });


  Route::group(['prefix'=>'categorias'],function(){
    Route::get('/',           'CategoriasController@index');
    Route::get('/listar',     'CategoriasController@listarCategorias');
    Route::get('/edit/{id}',  'CategoriasController@edit');
    Route::get('/add',        'CategoriasController@create');
    Route::post('/create',    'CategoriasController@store');
    Route::post('/update/{id}','CategoriasController@update');
    Route::get('/delete/{id}','CategoriasController@destroy');

     });

     Route::group(['prefix'=>'almacen/ingresos'],function(){
     Route::get('/listar',      'IngresosController@listar');
     Route::get('/edit/{id}',   'IngresosController@edit');
     Route::get('/',            'IngresosController@index');
     Route::get('/add',         'IngresosController@create');
     Route::post('/create',     'IngresosController@store');
     Route::post('/update/{id}','IngresosController@update');
     Route::get('/delete/{id}', 'IngresosController@destroy');
     Route::get('/mostrarArchivo/{archivo}', 'IngresosController@mostrarArchivo');
     Route::get('/deshabilitar/{id}', 'IngresosController@deshabilitar');
     Route::get('/habilitar/{id}', 'IngresosController@deshabilitar');

      });
