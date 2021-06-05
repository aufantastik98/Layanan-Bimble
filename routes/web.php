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


Route::get('/', 'MainController@index')->name('home');

Route::get('/categories', 'LayananController@index')->name('categories');
Route::get('/categories/{id}', 'LayananController@detail')->name('categories-detail');

Route::get('/details/{id}', 'DetailController@index')->name('detail');
Route::post('/details/{id}', 'DetailController@add')->name('detail-add');

Route::post('/checkout/callback', 'CheckoutController@callback')->name('midtrans-callback');

Route::get('/success', 'KeranjangController@success')->name('success');

Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');

Route::group(['middleware' => ['auth']], function () { 
        Route::get('/cart', 'KeranjangController@index')->name('cart');
        Route::delete('/cart/{id}', 'KeranjangController@Delete')->name('cart-delete');

        Route::post('/checkout', 'CheckoutController@process')->name('checkout');

        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        Route::get('/dashboard/jadwals', 'DashboardJadwalController@index')->name('dashboard-jadwal');

        Route::get('/dashboard/jadwals/create', 'DashboardJadwalController@create')
                ->name('dashboard-jadwal-create');

         Route::post('/dashboard/jadwals', 'DashboardJadwalController@store')
                ->name('dashboard-jadwal-store');

        Route::get('/dashboard/jadwals/{id}', 'DashboardJadwalController@details')->name('dashboard-jadwal-details');

         Route::post('/dashboard/jadwals/{id}', 'DashboardJadwalController@update')
        ->name('dashboard-jadwal-update');        

         Route::post('/dashboard/jadwals/gallery/upload', 'DashboardJadwalController@uploadGallery')
        ->name('dashboard-jadwal-gallery-upload');
    
        Route::get('/dashboard/jadwals/gallery/delete/{id}', 'DashboardJadwalController@deleteGallery')
        ->name('dashboard-jadwal-gallery-delete');
                 
        Route::get('/dashboard/transactions', 'DashboardTransaksiController@index')
                ->name('dashboard-transaction');

        Route::get('/dashboard/transactions/{id}', 'DashboardTransaksiController@details')->name('dashboard-transaction-details');  
        Route::post('/dashboard/transactions/{id}', 'DashboardTransaksiController@update')
        ->name('dashboard-transaction-update');
        

        Route::get('/dashboard/settings', 'DashboardSettingController@store')
                ->name('dashboard-settings-store');

        Route::get('/dashboard/account', 'DashboardSettingController@account')
                ->name('dashboard-settings-account');
        
        Route::post('/dashboard/update/{redirect}', 'DashboardSettingController@update')
        ->name('dashboard-settings-redirect');        
});

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth','admin'])
    ->group(function() {
        Route::get('/', 'DashboardController@index')->name('admin-dashboard');
        Route::resource('category', 'LayananController');
        Route::resource('user', 'UserController');
        Route::resource('jadwal', 'JadwalController');
        Route::resource('jadwal-gallery', 'JadwalGalleryController');
      
    });
       

Auth::routes();