<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use Illuminate\Support\Facades\Route;
Route::get('/',function(){
    return view('dashboard');
})->middleware(['auth']);
Route::resource('categories', CategoriesController::class);
