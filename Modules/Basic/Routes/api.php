<?php

use Modules\Basic\Http\Controllers\Api\CustomTranslationController;
use Modules\Basic\Http\Controllers\Api\MediaController;
use Modules\Basic\Http\Controllers\Api\LogController;
use Modules\Basic\Http\Controllers\Api\CommentController;
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
        Route::prefix('/basic')->name('basic.')->group(function () {
            //custom_translation
            Route::prefix('/custom_translation')->group(function () {
                Route::any('/list', [CustomTranslationController::class, 'list'])->name('list');
            });
            //media
            Route::prefix('/media')->group(function () {
                Route::delete('', [MediaController::class, 'remove'])->name('remove');
            });
            //log
            Route::prefix('/log')->group(function () {
                Route::post('/store', [LogController::class, 'store'])->name('store');
                Route::get('/getSaveSearch', [LogController::class, 'getSaveSearch'])->name('search.get');
            });
            Route::prefix('/comment')->group(function () {
                Route::any('/list', [CommentController::class, 'list'])->name('list');
            });
        });
    });
});

Route::group(['middleware' => 'auth:api', 'language'], function () {
    Route::name('api.')->group(function () {
        Route::prefix('/basic')->name('basic.')->group(function () {
            //log
            Route::prefix('/log')->group(function () {
                Route::get('/deleteSaveSearch', [LogController::class, 'deleteSaveSearch'])->name('search.delete');
            });
        });
    });
});
