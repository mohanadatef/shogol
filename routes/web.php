<?php

use Illuminate\Support\Facades\Route;
use Modules\CoreData\Http\Controllers\LanguageController;
use App\Http\Controllers\HomeController;
use Modules\CoreData\Http\Controllers\CountryController;
use Modules\CoreData\Http\Controllers\CityController;
use Modules\CoreData\Http\Controllers\StateController;
use Modules\CoreData\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::group(['middleware'=> 'admin', 'auth','language'],function() {
    /*dashboard list*/
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/logout',[LoginController::class,'logout'])->name('logout');
});
//language
Route::prefix('/language')->group(function () {
    Route::get('/list', [LanguageController::class, 'list'])
        ->name('language.list');
    Route::post('/setLang', [LanguageController::class, 'language'])
        ->name('setLang');
});
//country
Route::prefix('/country')->group(function () {
    Route::get('/list', [CountryController::class, 'list'])
        ->name('country.list');
});
//city
Route::prefix('/city')->group(function () {
    Route::get('/list', [CityController::class, 'list'])
        ->name('city.list');
});
//state
Route::prefix('/state')->group(function () {
    Route::get('/list', [StateController::class, 'list'])
        ->name('state.list');
});
//category
Route::prefix('/category')->group(function () {
    Route::get('/parent', [CategoryController::class, 'parent'])
        ->name('category.parent.list');
});
