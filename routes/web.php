<?php

use Illuminate\Support\Facades\Route;



// AUTH
Route::get('/login', function () { return view('auth.login');});
Route::get('/register', function () { return view('auth.register');});

// DASHBOARD
Route::get('/', function () { return view('dashboard.index');});
Route::get('/dashboard', function () { return view('dashboard.index');});