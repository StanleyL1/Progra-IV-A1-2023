<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorPatientController;
use App\Http\Controllers\SintomasPacienteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/doctors/{doctorId}/patients', [UserController::class, 'getPatients']);
Route::get('/patients/{patientId}/doctors', [UserController::class, 'getDoctors']);


Route::get('/session/userId', [SessionController::class, 'getUserId']);


Route::get('/session/doctorId', [SessionController::class, 'getDoctorId']);


Route::get('/assignedDoctor/{patientId}', [DoctorPatientController::class, 'getAssignedDoctor']);

Route::get('/chats', [ChatController::class, 'getChatHistory']);
Route::middleware('auth:api')->get('/api/sintomas-historial', [SintomasPacienteController::class, 'getSintomasHistorialApi']);
