<?php

use App\Models\Alumno;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;

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
/*Route::apiResources([
    'alumnos'=>AlumnoController::class
]);*/
Route::controller(AlumnoController::class)->group(function(){
    Route::get('/alumnos', 'index');
    Route::post('/alumnos', 'store');
    Route::put('/alumnos', 'update');
    Route::delete('/alumnos', 'destroy');
});

Route::get('/', function () {
    return view('welcome');
});
