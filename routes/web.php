<?php

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




Route::get('/libros', 'LibroController@index')->name('libro.index');
Route::POST('/libros/ver_libro', 'LibroController@show')->name('libro.view');
Route::POST('/libros/guardar_libro', 'LibroController@store')->name('libro.store');
Route::POST('/libros/update','LibroController@update')->name('libro.update');
Route::POST('/libros/destroy','LibroController@destroy')->name('libro.delete');
Route::POST('/libros/destroyVarios','LibroController@destroyVarios')->name('libro.deleteVarios');



Route::get('/', function(){
   /*  $categoria=App\Categoria::findOrFail(2);
    return $categoria->libros()->get();; */

    $libro=App\Libro::findOrFail(2);
    return $libro->categoria()->get();
});
