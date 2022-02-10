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

Route::get('/', function () {
    return view('welcome');
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('products')->name('products/')->group(static function() {
            Route::get('/',                                             'ProductsController@index')->name('index');
            Route::get('/create',                                       'ProductsController@create')->name('create');
            Route::post('/',                                            'ProductsController@store')->name('store');
            Route::get('/{product}/edit',                               'ProductsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ProductsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{product}',                                   'ProductsController@update')->name('update');
            Route::delete('/{product}',                                 'ProductsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('posts')->name('posts/')->group(static function() {
            Route::get('/',                                             'PostsController@index')->name('index');
            Route::get('/create',                                       'PostsController@create')->name('create');
            Route::post('/',                                            'PostsController@store')->name('store');
            Route::get('/{post}/edit',                                  'PostsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'PostsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{post}',                                      'PostsController@update')->name('update');
            Route::delete('/{post}',                                    'PostsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('writers')->name('writers/')->group(static function() {
            Route::get('/',                                             'WritersController@index')->name('index');
            Route::get('/create',                                       'WritersController@create')->name('create');
            Route::post('/',                                            'WritersController@store')->name('store');
            Route::get('/{writer}/edit',                                'WritersController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'WritersController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{writer}',                                    'WritersController@update')->name('update');
            Route::delete('/{writer}',                                  'WritersController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('books')->name('books/')->group(static function() {
            Route::get('/',                                             'BooksController@index')->name('index');
            Route::get('/create',                                       'BooksController@create')->name('create');
            Route::post('/',                                            'BooksController@store')->name('store');
            Route::get('/{book}/edit',                                  'BooksController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'BooksController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{book}',                                      'BooksController@update')->name('update');
            Route::delete('/{book}',                                    'BooksController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('tessters')->name('tessters/')->group(static function() {
            Route::get('/',                                             'TesstersController@index')->name('index');
            Route::get('/create',                                       'TesstersController@create')->name('create');
            Route::post('/',                                            'TesstersController@store')->name('store');
            Route::get('/{tesster}/edit',                               'TesstersController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'TesstersController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{tesster}',                                   'TesstersController@update')->name('update');
            Route::delete('/{tesster}',                                 'TesstersController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('rooms')->name('rooms/')->group(static function() {
            Route::get('/',                                             'RoomsController@index')->name('index');
            Route::get('/create',                                       'RoomsController@create')->name('create');
            Route::post('/',                                            'RoomsController@store')->name('store');
            Route::get('/{room}/edit',                                  'RoomsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'RoomsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{room}',                                      'RoomsController@update')->name('update');
            Route::delete('/{room}',                                    'RoomsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('customers')->name('customers/')->group(static function() {
            Route::get('/',                                             'CustomersController@index')->name('index');
            Route::get('/create',                                       'CustomersController@create')->name('create');
            Route::post('/',                                            'CustomersController@store')->name('store');
            Route::get('/{customer}/edit',                              'CustomersController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'CustomersController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{customer}',                                  'CustomersController@update')->name('update');
            Route::delete('/{customer}',                                'CustomersController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('hotelrooms')->name('hotelrooms/')->group(static function() {
            Route::get('/',                                             'HotelroomsController@index')->name('index');
            Route::get('/create',                                       'HotelroomsController@create')->name('create');
            Route::post('/',                                            'HotelroomsController@store')->name('store');
            Route::get('/{hotelroom}/edit',                             'HotelroomsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'HotelroomsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{hotelroom}',                                 'HotelroomsController@update')->name('update');
            Route::delete('/{hotelroom}',                               'HotelroomsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('newcustomers')->name('newcustomers/')->group(static function() {
            Route::get('/',                                             'NewcustomersController@index')->name('index');
            Route::get('/create',                                       'NewcustomersController@create')->name('create');
            Route::post('/',                                            'NewcustomersController@store')->name('store');
            Route::get('/{newcustomer}/edit',                           'NewcustomersController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'NewcustomersController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{newcustomer}',                               'NewcustomersController@update')->name('update');
            Route::delete('/{newcustomer}',                             'NewcustomersController@destroy')->name('destroy');
        });
    });
});