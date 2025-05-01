<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\test2Controller;
<<<<<<< HEAD
use App\Http\Controllers\PrivateDebtController;
use App\Http\Controllers\FriendController;
=======
use App\Http\Controllers\Page3Controller;

>>>>>>> Page3

Route::get('/', function () {
    return view('test');
});

Route::post('/register', [UserController::class,'register']);
Route::get('/test2', [test2Controller::class, 'index'])->middleware('auth');
Route::post('/logout', [UserController::class,'logout']); // Décommenter cette ligne
Route::post('/login', [UserController::class,'login']);
// Route::post('/create-dette', [debtController::class,'createDebt']);
Route::get('/Page3', [Page3Controller::class, 'Page3'])->name('Page3');
Route::get('/profile', function () {
    return view('profile', ['user' => auth()->user()]);
})->middleware('auth');
Route::post('/profile/update', [App\Http\Controllers\UserController::class, 'updateProfile'])->middleware('auth');
Route::get('/test2', [test2Controller::class, 'test2'])->middleware('auth');
<<<<<<< HEAD
Route::post('/private-debts', [PrivateDebtController::class, 'store'])->name('private_debts.store')->middleware('auth');
Route::post('/friends/add', [FriendController::class, 'add'])->name('friends.add')->middleware('auth');
=======


use App\Http\Controllers\DebtController;
Route::post('/debts/update', [DebtController::class, 'update'])
     ->middleware('auth')
     ->name('debts.update');



>>>>>>> Page3
