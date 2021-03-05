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

use App\Http\Controllers\KelasController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
    ]);
    
Route::group(['middleware'=>['auth','checkrole:admin,guru']],function(){

    route::get('/siswa','SiswaController@index')->name('siswa.index');
    route::post('/siswa/store','SiswaController@store')->name('siswa.store');
    route::put('siswa/{id}','SiswaController@update')->name('siswa.update');
    route::delete('siswa/{id}','SiswaController@destroy')->name('siswa.destroy');
    route::get('siswa/{id}','SiswaController@profile')->name('siswa.profile');
    route::resource('/kelas','KelasController');
    route::resource('/guru','GuruController');
    route::resource('/pengumuman','PengumumanController');
   
});
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

