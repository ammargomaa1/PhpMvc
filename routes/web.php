<?php

use App\Controllers\HomeController;
use Illuminate\Http\Route;


Route::get('/home',[HomeController::class,'index']);
Route::get('/',[HomeController::class,'index']);