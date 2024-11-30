<?php

use App\Controllers\AuthenticatorController;
use Core\Router\Route;


Route::get('/', [AuthenticatorController::class, 'showLogin'])->name('login');

Route::post('/index.php', [AuthenticatorController::class, 'authenticate']);

Route::get('/index.php', [AuthenticatorController::class, 'logout']);

Route::get('/user', [AuthenticatorController::class, 'user'])->name('user');


Route::get('/admin', [AuthenticatorController::class, 'admin'])->name('admin');
