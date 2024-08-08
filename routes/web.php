<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiyetController;
use App\Http\Controllers\PDFController;
Route::get('/', function () {return view('welcome');})->name('main');
Route::get('/tables',[DiyetController::class ,'index'] )->name('tables');
