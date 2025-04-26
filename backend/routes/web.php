<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\debtController;
use App\Http\Controllers\utilisateurController;

Route::get('/', function () {
    return view('test');
});

Route::post('/register', [utilisateurController::class,'register']);

Route::post('/logout', [utilisateurController::class,'logout']);

Route::post('/login', [utilisateurController::class,'login']);

Route::post('/create-dette', [debtController::class,'createDebt']);