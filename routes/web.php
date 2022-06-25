<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\alumnosController;
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
    return view('auth.login');
});


/*
*/

Auth::routes();


Route::get('/home',[App\Http\Controllers\dashboardController::class,'index'])->name('Home');
Route::get('/alumnos',[App\Http\Controllers\alumnosController::class,'alumnos'])->name('Alumnos');
Route::get('/estadisticas',[App\Http\Controllers\estadisticasController::class,'estadisticas'])->name('Estadisticas');
Route::get('/materias/{id}',[App\Http\Controllers\materiasController::class,'materias'])->name('Materias');
Route::post('/alumnos/importar',[App\Http\Controllers\alumnosController::class,'importar'])->name('Importar');
