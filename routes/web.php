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
use App\Jadwal;

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
    route::get('siswa/{id}/profile','SiswaController@profile')->name('siswa.profile');
    route::post('siswa/{id}/addnilai','SiswaController@addnilai');
    route::resource('/kelas','KelasController');
    route::resource('/guru','GuruController');
    route::resource('/pengumuman','PengumumanController');
    route::get('/mapel','MapelController@index')->name('mapel.index');
    route::post('/mapel/store','MapelController@store')->name('mapel.store');
    route::put('/mapel/{id}','MapelController@update')->name('mapel.update');
    route::resource('/jadwal','JadwalController');

});
Route::group(['middleware'=>'auth','checkrole:guru'],function(){

});
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

