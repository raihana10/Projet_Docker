<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\debtController;
use App\Http\Controllers\utilisateurController;

Route::get('/', function () {
    return view('test');
});


Route::post('/register', [utilisateurController::class,'register']);

Route::get('/test2', function () {
    return view('test2');
});

// Route::post('/logout', [utilisateurController::class,'logout']);

// Route::post('/login', [utilisateurController::class,'login']);

// Route::post('/create-dette', [debtController::class,'createDebt']);