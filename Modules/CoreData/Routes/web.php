<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'admin', 'auth', 'language'], function () {
    Route::prefix('coredata')->group(function () {
        /* language route list */
        Route::apiresource('language', LanguageController::class, ['except' => ['show', 'update']])
            ->parameters(['language' => 'id']);
        Route::controller(LanguageController::class)->prefix('/language')->name('language.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::post('/{id}', 'update')->name('update');
            Route::get('/{id}', 'show')->name('show');
        });
        /* gender route list */
        Route::apiresource('gender', GenderController::class, ['except' => ['show', 'update']])
            ->parameters(['gender' => 'id']);
        Route::controller(GenderController::class)->prefix('/gender')->name('gender.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::post('/{id}', 'update')->name('update');
            Route::get('/{id}', 'show')->name('show');
        });
        /* bank route list */
        Route::apiresource('bank', BankController::class, ['except' => ['show', 'update']])
            ->parameters(['bank' => 'id']);
        Route::controller(BankController::class)->prefix('/bank')->name('bank.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::post('/{id}', 'update')->name('update');
            Route::get('/{id}', 'show')->name('show');
        });
        /* job name route list */
        Route::apiresource('job_name', JobNameController::class, ['except' => ['show', 'update']])
            ->parameters(['job_name' => 'id']);
        Route::controller(JobNameController::class)->prefix('/job_name')->name('job_name.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::post('/{id}', 'update')->name('update');
            Route::get('/{id}', 'show')->name('show');
        });
        /* level route list */
        Route::apiresource('level', LevelController::class, ['except' => ['show', 'update']])
            ->parameters(['level' => 'id']);
        Route::controller(LevelController::class)->prefix('/level')->name('level.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::post('/{id}', 'update')->name('update');
            Route::get('/{id}', 'show')->name('show');
        });
        /* country route list */
        Route::apiresource('country', CountryController::class, ['except' => ['show', 'update']])
            ->parameters(['country' => 'id']);
        Route::controller(CountryController::class)->prefix('/country')->name('country.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::post('/{id}', 'update')->name('update');
            Route::get('/{id}', 'show')->name('show');
        });
        /* city route list */
        Route::apiresource('city', CityController::class, ['except' => ['show', 'update']])
            ->parameters(['city' => 'id']);
        Route::controller(CityController::class)->prefix('/city')->name('city.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::post('/{id}', 'update')->name('update');
            Route::get('/{id}', 'show')->name('show');
        });
        /* tag route list */
        Route::apiresource('tag', TagController::class, ['except' => ['show', 'update']])
            ->parameters(['tag' => 'id']);
        Route::controller(TagController::class)->prefix('/tag')->name('tag.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::post('/{id}', 'update')->name('update');
            Route::get('/{id}', 'show')->name('show');
        });
        /* state route list */
        Route::apiresource('state', StateController::class, ['except' => ['show', 'update']])
            ->parameters(['state' => 'id']);
        Route::controller(StateController::class)->prefix('/state')->name('state.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::post('/{id}', 'update')->name('update');
            Route::get('/{id}', 'show')->name('show');
        });
        /* Area route list */
        Route::apiresource('area', AreaController::class, ['except' => ['show', 'update']])
            ->parameters(['state' => 'id']);
        Route::controller(AreaController::class)->prefix('/area')->name('area.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::post('/{id}', 'update')->name('update');
            Route::get('/{id}', 'show')->name('show');
        });
        /* nationality route list */
        Route::apiresource('nationality', NationalityController::class, ['except' => ['show', 'update']])
            ->parameters(['nationality' => 'id']);
        Route::controller(NationalityController::class)->prefix('/nationality')->name('nationality.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
            Route::post('/{id}', 'update')->name('update');
            Route::get('/{id}', 'show')->name('show');
        });
        /* category route list */
        Route::resource('category',CategoryController::class,['except'=>['show','update']])
            ->parameters(['category'=>'id']);
        Route::controller(CategoryController::class)->prefix('/category')->name('category.')->group(function()
        {
            Route::get('/change_status/{id}','changeStatus')->name('status');
            Route::post('/{id}','update')->name('update');
            Route::get('/{id}','show')->name('show');
        });
        /* social route list */
        Route::apiresource('social',SocialController::class,['except'=>['show','update']])
            ->parameters(['social'=>'id']);
        Route::controller(SocialController::class)->prefix('/social')->name('social.')->group(function()
        {
            Route::get('/change_status/{id}','changeStatus')->name('status');
            Route::post('/{id}','update')->name('update');
            Route::get('/{id}','show')->name('show');
        });
        /* status route list */
        Route::resource('status',StatusController::class,['except'=>['show','update']])
            ->parameters(['status'=>'id']);
        Route::controller(StatusController::class)->prefix('/status')->name('status.')->group(function()
        {
            Route::get('/change_status/{id}','changeStatus')->name('status');
            Route::post('/{id}','update')->name('update');
            Route::get('/{id}','show')->name('show');
        });
        /* currency route list */
        Route::apiresource('currency',CurrencyController::class,['except'=>['show','update']])
            ->parameters(['currency'=>'id']);
        Route::controller(CurrencyController::class)->prefix('/currency')->name('currency.')->group(function()
        {
            Route::get('/change_status/{id}','changeStatus')->name('status');
            Route::post('/{id}','update')->name('update');
            Route::get('/{id}','show')->name('show');
        });
    });
});
