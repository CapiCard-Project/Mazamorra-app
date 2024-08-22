<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/registrar-usuario', [UserController::class, 'registrarUsuario']);
Route::post('/login', [UserController::class, 'login']);