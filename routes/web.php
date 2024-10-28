<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WithdrawController;

Route::get('/', [WithdrawController::class, 'index']);
Route::resource('withdraw', WithdrawController::class);