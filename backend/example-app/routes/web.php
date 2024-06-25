<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(UserController::class)->group(function(){
    Route::get('/all/users', 'index')->name('show.all.users');
    Route::post('/user/create', 'create')->name('show.all.users');
});
