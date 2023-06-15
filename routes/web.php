<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginAsociatesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\SintomasPacienteController;
use App\Http\Controllers\SignosVitalesController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/Norris', function () {
    return view('welcome');
})->name('Norris');

Route::get('/register',[RegisterController::class ,'show'])->name('register');
Route::post('/register',[RegisterController::class ,'register']);

Route::get('/login',[LoginController::class ,'show'])->name('login');
Route::post('/login',[LoginController::class ,'login']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', function () {
        return view('homeNorris');
    })->name('home');
});

Route::get('/logout',[LogoutController::class ,'logout']);

Route::get('/app', function () {
    return view('layouts.appweb');
});

Route::get('/asociados', function () {
    return view('asociados');
})->name('asociados');

Route::get('/loginAsociados',[LoginAsociatesController::class ,'show'])->name('loginAsociados');
Route::post('/loginAsociados',[LoginAsociatesController::class ,'login']);

Route::get('/users', function () {
    return view('listadoPac');
});

Route::get('/pago', function () {
    return view('pago');
});

Route::prefix('paypal')->group(function () {
    Route::get('payment', [PaymentControsler::class, 'show'])->name('create.payment');
    Route::post('handle-payment', [PaymentController::class, 'handlePayment'])->name('make.payment');
    Route::get('cancel-payment', [PaymentController::class, 'paymentCancel'])->name('cancel.payment');
    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('success.payment');
});



Route::get('/chat',function(){
    return view ('chat');
});

Route::get('/chatp',function(){
    return view ('chatPacientes');
});

Route::get('/sintomas',function(){
    return view ('registroSintomas');
});

Route::post('/sintoma', [SintomasPacienteController::class,'store'])->name('sintPaciente');


Route::get(
    '/signos',function(){
        return view('registroSignos');
    }
);

Route::get(
    '/h',function(){
        return view('historialSintomas');
    }
);

Route::post('/signo', [SignosVitalesController::class,'store'])->name('singPaciente');

Route::get('/historialSintomas', [SintomasPacienteController::class, 'showSintomasHistorial'])->name('historialSintomas');

Route::get('/historialSignosVitales', [SignosVitalesController::class, 'showSignosVitalesHistorial'])->name('historialSignosVitales');
