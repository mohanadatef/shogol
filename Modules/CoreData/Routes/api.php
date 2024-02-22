<?php

use Illuminate\Support\Facades\Route;
use Modules\CoreData\Entities\Area;
use Modules\CoreData\Http\Controllers\Api\AreaController;
use Modules\CoreData\Http\Controllers\Api\LanguageController;
use Modules\CoreData\Http\Controllers\Api\CategoryController;
use Modules\CoreData\Http\Controllers\Api\CountryController;
use Modules\CoreData\Http\Controllers\Api\CityController;
use Modules\CoreData\Http\Controllers\Api\StateController;
use Modules\CoreData\Http\Controllers\Api\GenderController;
use Modules\CoreData\Http\Controllers\Api\NationalityController;
use Modules\CoreData\Http\Controllers\Api\LevelController;
use Modules\CoreData\Http\Controllers\Api\SocialController;
use Modules\CoreData\Http\Controllers\Api\CoreDataController;
use Modules\CoreData\Http\Controllers\Api\StatusController;
use Modules\CoreData\Http\Controllers\Api\CurrencyController;
use Modules\CoreData\Http\Controllers\Api\JobNameController;
use Modules\CoreData\Http\Controllers\Api\TagController;
use Modules\CoreData\Http\Controllers\Api\BankController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api', 'language'], function () {
    Route::name('api.')->group(function () {
        Route::prefix('/coredata')->name('coredata.')->group(function () {
            //core data
            Route::any('', [CoreDataController::class, 'list'])->name('list');
            //language
            Route::prefix('/language')->group(function () {
                Route::any('/list', [LanguageController::class, 'list'])->name('list');
            });
            //category
            Route::prefix('/category')->name('category.')->group(function () {
                Route::any('/list', [CategoryController::class, 'list'])->name('list');
            });
            //social
            Route::prefix('/social')->name('social.')->group(function () {
                Route::any('/list', [SocialController::class, 'list'])->name('list');
            });
            //country
            Route::prefix('/country')->name('country.')->group(function () {
                Route::any('/list', [CountryController::class, 'list'])->name('list');
            });
            //city
            Route::prefix('/city')->name('city.')->group(function () {
                Route::any('/list', [CityController::class, 'list'])->name('list');
            });
            //tag
            Route::prefix('/tag')->name('tag.')->group(function () {
                Route::any('/search', [TagController::class, 'search'])->name('search');
            });
            //state
            Route::prefix('/state')->name('state.')->group(function () {
                Route::any('/list', [StateController::class, 'list'])->name('list');
            });
            //area
            Route::prefix('/area')->name('area.')->group(function () {
                Route::any('/list', [AreaController::class, 'list'])->name('list');
            });
            //gender
            Route::prefix('/gender')->group(function () {
                Route::any('/list', [GenderController::class, 'list'])
                    ->name('gender.list');
            });
            //gender
            Route::prefix('/bank')->group(function () {
                Route::any('/list', [BankController::class, 'list'])
                    ->name('bank.list');
            });
            //job_name
            Route::prefix('/job_name')->group(function () {
                Route::any('/list', [JobNameController::class, 'list'])
                    ->name('job_name.list');
            });
            //level
            Route::prefix('/level')->group(function () {
                Route::any('/list', [LevelController::class, 'list'])
                    ->name('level.list');
            });
            //nationality
            Route::prefix('/nationality')->group(function () {
                Route::any('/list', [NationalityController::class, 'list'])
                    ->name('nationality.list');
            });
            //status
            Route::prefix('/status')->group(function () {
                Route::any('/list', [StatusController::class, 'list'])
                    ->name('status.list');
            });
            //currency
            Route::prefix('/currency')->group(function () {
                Route::any('/list', [CurrencyController::class, 'list'])
                    ->name('currency.list');
            });
        });
    });
});
