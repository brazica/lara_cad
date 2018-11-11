  <?php

Route::get('/', function () {
    return view('index');
});

Route::get('/games', 'ControladorGame@indexView');
Route::get('/plataform', 'ControladorPlataform@index');
Route::get('/plataform/new', 'ControladorPlataform@create');
Route::post('/plataform', 'ControladorPlataform@store');
Route::get('/plataform/delete/{id}', 'ControladorPlataform@destroy');
Route::get('/plataform/edit/{id}', 'ControladorPlataform@edit');
Route::post('/plataform/{id}', 'ControladorPlataform@update');
