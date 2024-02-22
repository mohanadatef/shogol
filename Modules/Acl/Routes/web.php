<?php
use Modules\Acl\Http\Controllers\ForgetPasswordController;
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
Route::prefix('acl')->group(function() {
    /* User route list */
    Route::apiresource('user', UserController::class, ['except' => ['show', 'update']])
        ->parameters(['user' => 'id']);
    Route::controller(UserController::class)->prefix('/user')->name('user.')->group(function () {
        Route::get('/change_status/{id}', 'changeStatus')->name('status');
        Route::get('/accept_approve/{id}', 'acceptApprove')->name('accept_approve');
        Route::post('/reject_approve/{id}', 'rejectApprove')->name('reject_approve');
        Route::get('/verified/{id}', 'verified')->name('verified');
    });
    /* role route list */
    Route::resource('role',RoleController::class,['except'=>['show','update']])
        ->parameters(['role'=>'id']);
    Route::controller(RoleController::class)->prefix('/role')->name('role.')->group(function()
    {
        Route::post('/{id}','update')->name('update');
        Route::get('/{id}','show')->name('show');
    });
    /* permission route list */
    Route::apiresource('permission',PermissionController::class,['except'=>['show','update']])
        ->parameters(['permission'=>'id']);
    Route::controller(PermissionController::class)->prefix('/permission')->name('permission.')->group(function()
    {
        Route::post('/{id}','update')->name('update');
        Route::get('/{id}','show')->name('show');
    });
});
});
Route::group(['middleware' => 'language'], function () {
    Route::prefix('acl')->group(function() {
        Route::prefix('/forget_password')->name('forget_password.')->group(function () {
            //forget_password
            Route::get('/', [ForgetPasswordController::class, 'index'])->name('show');
            Route::get('/cheek', [ForgetPasswordController::class, 'code'])->name('code');
            Route::post('/cheek', [ForgetPasswordController::class, 'store'])->name('cheek_email');
            Route::get('/code', [ForgetPasswordController::class, 'code'])->name('code');
            Route::post('/code', [ForgetPasswordController::class, 'check'])->name('cheek_code');
        });
    });
});
