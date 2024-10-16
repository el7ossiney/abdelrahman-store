<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use Illuminate\Support\Facades\Route;
Route::get('/',function(){
    return view('dashboard');
})->middleware(['auth'])->name('dashboard.dash');
Route::resource('categories', CategoriesController::class)->middleware(['auth']);