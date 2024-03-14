<?php

use App\Http\Controllers\Image\IndexController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['prefix'=>'images'], function (){
    Route::post('/upload', [\App\Http\Controllers\Image\CreateController::class, 'store'])->name('image.store');
    Route::get('', [IndexController::class, 'index'])->name('image.index');
    Route::get('{id}', [IndexController::class, 'show'])->name('image.show');
});
Route::get('test', function (){ return 1;});
