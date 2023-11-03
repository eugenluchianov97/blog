<?php

use App\Http\Controllers\AuthController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

Route::get('/create-roles', function(){
    Role::create(['name' => 'admin']);
    Role::create(['name' => 'user']);
});

Route::group([
    'prefix' => \App\Services\Localization\LocalizationService::locale(),
    'middleware' => 'setLocale'
], function(){
    Route::post('login', \App\Http\Controllers\Auth\LoginController::class)->name('login');
    Route::get('login', function() { return view('auth.login');})->name('login.view');

    Route::post('logout', \App\Http\Controllers\Auth\LogoutController::class)->name('logout');

    Route::get('registration', [AuthController::class, 'registration'])->name('register');
    Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');


    /** Admin **/
    Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => ['auth.custom']], function() {
        Route::get('/', \App\Http\Controllers\Admin\MainController::class)->name('index');

        Route::group(['middleware' => ['is_admin'],'prefix' => 'users', 'as' => 'users.'], function() {
            Route::get('/', \App\Http\Controllers\Admin\User\IndexController::class)->name('index');
            Route::get('/create', \App\Http\Controllers\Admin\User\CreateController::class)->name('create');
            Route::post('/', \App\Http\Controllers\Admin\User\StoreController::class)->name('store');
            Route::get('/{user}/edit', \App\Http\Controllers\Admin\User\EditController::class)->name('edit');
            Route::get('/{user}/show', \App\Http\Controllers\Admin\User\ShowController::class)->name('show');
            Route::put('/{user}', \App\Http\Controllers\Admin\User\UpdateController::class)->name('update');
            Route::delete('/{user}', \App\Http\Controllers\Admin\User\DeleteController::class)->name('delete');
        });

        Route::group(['middleware' => ['is_admin'],'prefix' => 'categories', 'as' => 'categories.'], function() {
            Route::get('/', \App\Http\Controllers\Admin\Category\IndexController::class)->name('index');
            Route::get('/create', \App\Http\Controllers\Admin\Category\CreateController::class)->name('create');
            Route::post('/', \App\Http\Controllers\Admin\Category\StoreController::class)->name('store');
            Route::get('/{category}/edit', \App\Http\Controllers\Admin\Category\EditController::class)->name('edit');
            Route::get('/{category}/show', \App\Http\Controllers\Admin\Category\ShowController::class)->name('show');
            Route::put('/{category}', \App\Http\Controllers\Admin\Category\UpdateController::class)->name('update');
            Route::delete('/{category}', \App\Http\Controllers\Admin\Category\DeleteController::class)->name('delete');
        });

        Route::group(['middleware' => ['is_admin'],'prefix' => 'products', 'as' => 'products.'], function() {
            Route::get('/', \App\Http\Controllers\Admin\Product\IndexController::class)->name('index');
            Route::get('/create', \App\Http\Controllers\Admin\Product\CreateController::class)->name('create');
            Route::post('/', \App\Http\Controllers\Admin\Product\StoreController::class)->name('store');
            Route::get('/{product}/edit', \App\Http\Controllers\Admin\Product\EditController::class)->name('edit');
            Route::get('/{product}/show', \App\Http\Controllers\Admin\Product\ShowController::class)->name('show');
            Route::put('/{product}', \App\Http\Controllers\Admin\Product\UpdateController::class)->name('update');
            Route::delete('/{product}', \App\Http\Controllers\Admin\Product\DeleteController::class)->name('delete');
        });

        Route::group(['prefix' => 'posts', 'as' => 'posts.'], function() {
            Route::get('/', \App\Http\Controllers\Admin\Post\IndexController::class)->name('index');
            Route::get('/create', \App\Http\Controllers\Admin\Post\CreateController::class)->name('create');
            Route::post('/', \App\Http\Controllers\Admin\Post\StoreController::class)->name('store');
            Route::get('/{post}/edit', \App\Http\Controllers\Admin\Post\EditController::class)->name('edit');
            Route::get('/{post}/show', \App\Http\Controllers\Admin\Post\ShowController::class)->name('show');
            Route::put('/{post}', \App\Http\Controllers\Admin\Post\UpdateController::class)->name('update');
            Route::delete('/{post}', \App\Http\Controllers\Admin\Post\DeleteController::class)->name('delete');
        });

        Route::post('/ajax/image',\App\Http\Controllers\Admin\Image\StoreController::class)->name('image.store');

    });

    /** Front **/
    Route::get('/', \App\Http\Controllers\Front\MainController::class)->name('index');
    Route::get('/category/{slug}', \App\Http\Controllers\Front\Category\IndexController::class)->name('category.index');

});






