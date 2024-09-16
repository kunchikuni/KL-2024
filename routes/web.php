<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return response
     ('Welcome to the KL Lightbox');
});

//Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/register', [AuthController::class, 'register'])->name('dashboard');

