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

Route::group(['middleware' => 'admin', 'auth', 'language'], function () {
    Route::prefix('setting')->group(function () {
        /* contact_us route list */
        Route::apiresource('contact_us', ContactUsController::class, ['except' => ['show', 'update']])
            ->parameters(['contact_us' => 'id']);
        Route::controller(ContactUsController::class)->prefix('/contact_us')->name('contact_us.')->group(function () {
            Route::get('/change_status/{id}', 'changeStatus')->name('status');
        });
        /* page route list */
        Route::resource('page',PageController::class,['except'=>['show','update']])
            ->parameters(['page'=>'id']);
        Route::controller(PageController::class)->prefix('/page')->name('page.')->group(function()
        {
            Route::get('/change_status/{id}','changeStatus')->name('status');
            Route::post('/{id}','update')->name('update');
            Route::get('/{id}','show')->name('show');
        });
        /*setting*/
        Route::controller(SettingController::class)->name('setting.')->group(function () {
            Route::get('','edit')->name('edit');
            Route::get('home','home')->name('home');
            Route::post('','update')->name('update');
        });
        /* fq route list */
        Route::apiresource('fq',FqController::class,['except'=>['show','update']])
            ->parameters(['fq'=>'id']);
        Route::controller(FqController::class)->prefix('/fq')->name('fq.')->group(function()
        {
            Route::get('/change_status/{id}','changeStatus')->name('status');
            Route::post('/{id}','update')->name('update');
            Route::get('/{id}','show')->name('show');
        });
        /* cancellation route list */
        Route::apiresource('cancellation',CancellationController::class,['except'=>['show','update']])
            ->parameters(['cancellation'=>'id']);
        Route::controller(CancellationController::class)->prefix('/cancellation')->name('cancellation.')->group(function()
        {
            Route::get('/change_status/{id}','changeStatus')->name('status');
            Route::post('/{id}','update')->name('update');
            Route::get('/{id}','show')->name('show');
        });
        Route::controller(NotificationController::class)->prefix('/notification')->name('notification.')->group(function()
    {
        Route::get('/index','index')->name('index');
        Route::get('/system','systemNotification')->name('system');
        Route::get('/push','create')->name('push');
        Route::post('/store','store')->name('store');
        Route::get('/read/{id}','readNotification')->name('read');
    });
    Route::controller(ReportController::class)->prefix('/report')->name('report.')->group(function()
    {
        Route::get('/','index')->name('index');
        Route::post('solved/{id}','solved')->name('solved');
    });
    });

});
