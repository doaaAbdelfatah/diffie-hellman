<?php

use App\Http\Controllers\DHAttackController;
use App\Http\Controllers\DiffieHellmanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeyExchangeController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/diffie-hellman', [DiffieHellmanController::class, 'index']);
Route::get('/brute-force', [DHAttackController::class, 'bruteForce']);


Route::get('/key-exchange', [KeyExchangeController::class, 'showForm'])->name('showForm');
Route::post('/key-exchange', [KeyExchangeController::class, 'generateKey'])->name('generateKey');
