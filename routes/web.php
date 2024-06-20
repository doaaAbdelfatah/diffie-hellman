<?php

use App\Http\Controllers\DHAttackController;
use App\Http\Controllers\DiffieHellmanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/diffie-hellman', [DiffieHellmanController::class, 'index']);
Route::get('/brute-force', [DHAttackController::class, 'bruteForce']);
