<?php

use Api\AdController;
use Api\TaskController;
use Api\OfferController;

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
        Route::group(['middleware' => 'auth:api'], function () {
            //ad
            Route::controller(AdController::class)->prefix('/ad')->name('ad.')->group(function () {
                Route::post('store', 'store')->name('store');
                Route::post('update/{id}', 'update')->name('update');
                Route::post('cansel/{id}', 'cansel')->name('cansel');
                Route::delete('delete/{id}', 'delete')->name('delete');
                Route::post('time/{id}', 'updateTime')->name('time');
                Route::any('my_list', 'myList')->name('my_list');
            });
            //task
            Route::controller(TaskController::class)->prefix('/task')->name('task.')->group(function () {
                Route::get('/change_status_offer/{id}', 'offerStatus')->name('offer_status');
                Route::post('store', 'store')->name('store');
                Route::post('update/{id}', 'update')->name('update');
                Route::post('cansel/{id}', 'cansel')->name('cansel');
                Route::post('time/{id}', 'updateTime')->name('time');
                Route::post('done_freelancer/{id}', 'doneFreelancer')->name('doneFreelancer');
                Route::post('unapprove_freelancer', 'unApproveFreelancer')->name('unApproveFreelancer');
                Route::post('unapprove_client', 'unApproveClient')->name('unApproveClient');
                Route::post('done_client/{id}', 'doneClient')->name('doneClient');
                Route::any('my_list_special', 'myListSpecial')->name('list.special');
                Route::any('list_special', 'ListSpecial')->name('list.specials');
                Route::any('list_copy', 'listCopy')->name('list.copy');
                Route::any('my_list', 'myList')->name('list.my');
                Route::any('my_offer', 'myListOffer')->name('list.offer');
                Route::post('comment','comment')->name('comment');
                Route::delete('delete/{id}', 'delete')->name('delete');
            });
            //offer
            Route::controller(OfferController::class)->prefix('/offer')->name('offer.')->group(function () {
                Route::post('store', 'store')->name('store');
                Route::post('update/{id}','update')->name('update');
                Route::post('cansel/{id}','cansel')->name('cansel');
                Route::post('approve/{id}','acceptApprove')->name('approve');
                Route::post('unapprove/{id}','unApproved')->name('unapprove');
                Route::post('time/{id}','updateTime')->name('time');
                Route::post('edit/{id}','edit')->name('edit');
                Route::any('list','list')->name('list');
                Route::any('my_list','myList')->name('my_list');
                Route::post('comment','comment')->name('comment');
            });
        });
        //ad
        Route::controller(AdController::class)->prefix('/ad')->name('ad.')->group(function () {
            Route::any('list', 'list')->name('list');
            Route::get('show/{id}', 'show')->name('show');
            Route::any('searchName', 'searchTitle')->name('search.name');
        });
        //task
        Route::controller(TaskController::class)->prefix('/task')->name('task.')->group(function () {
            Route::any('list',  'list')->name('list');
            Route::get('show/{id}', 'show')->name('show');
            Route::any('searchName', 'searchTitle')->name('search.name');
        });
    });
});
