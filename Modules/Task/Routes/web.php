<?php

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

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin', 'auth', 'language'], function () {
    Route::prefix('task')->group(function() {
        /* ad route list */
        Route::apiresource('ad', AdController::class, ['except' => ['show', 'update']])
            ->parameters(['ad' => 'id']);
        Route::controller(AdController::class)->prefix('/ad')->name('ad.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::post('/cansel/{id}', 'cansel')->name('cansel');
            Route::get('/show/{id}', 'show')->name('show');
        });
        /* task route list */
        Route::apiresource('task', TaskController::class, ['except' => ['show', 'update']])
            ->parameters(['task' => 'id']);
        Route::controller(TaskController::class)->prefix('/task')->name('task.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::get('/accept_approve/{id}', 'acceptApprove')->name('accept_approve');
            Route::post('/reject_approve/{id}', 'rejectApprove')->name('reject_approve');
            Route::get('/{id}', 'show')->name('show');
            Route::post('/cansel/{id}', 'cansel')->name('cansel');
            Route::post('/{id}','update')->name('update');
        });
    });
});
