<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth:sanctum','verified'])->group(function(){
    Route::resource('/anuncio', App\Http\Controllers\AnuncioController::class);
    Route::resource('/categoria', App\Http\Controllers\CategoriaController::class);
}); 




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/save', [App\Http\Controllers\AnuncioController::class, 'store'])->name('save');
Route::get('/form', [App\Http\Controllers\AnuncioController::class, 'create']);

Route::post('/saveedit', [App\Http\Controllers\AnuncioController::class, 'update'])->name('saveedit');
Route::get('/formedit/:id', [App\Http\Controllers\AnuncioController::class, 'edit']);

Route::post('/anunciophoto/{id}', [App\Http\Controllers\AnuncioController::class, 'subirImagen'])->name("subirImagenPersona");








