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


Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
    ]);

    Route::group(['middleware'=>['auth','checkrole:admin']],function(){    
    
        route::post('/siswa/{id}/addnilai','SiswaController@addnilai');
        route::post('/siswa/{id}/updatenilai','SiswaController@updatenilai');
        route::delete('/siswa/{id}/{idmapel}/deletenilai','SiswaController@deletenilai');
        route::resource('/guru','GuruController');
        route::get('/mapel','MapelController@index')->name('mapel.index');
        route::post('/mapel/store','MapelController@store')->name('mapel.store');
        route::put('/mapel/{id}','MapelController@update')->name('mapel.update');
        route::post('/siswa/import', 'SiswaController@import_excel')->name('siswa.import');
        route::get('/siswa/export', 'SiswaController@export_excel')->name('siswa.export');
        route::post('/guru/import', 'GuruController@import_excel')->name('guru.import');
        route::get('/guru/cetak/excel', 'GuruController@cetak_excel');
    });
    // admin
Route::group(['middleware'=>['auth','checkrole:admin,guru']],function(){

    route::get('/siswa','SiswaController@index')->name('siswa.index');
    route::post('/siswa/store','SiswaController@store')->name('siswa.store');
    route::put('siswa/{id}','SiswaController@update')->name('siswa.update');
    route::delete('siswa/{id}','SiswaController@destroy')->name('siswa.destroy');
    route::get('/siswa/{id}/profile','SiswaController@profile')->name('siswa.profile');
    route::resource('/kelas','KelasController');
    route::post('/siswa/{id}/addnilai','SiswaController@addnilai');
    route::post('/siswa/{id}/updatenilai','SiswaController@updatenilai');
    route::delete('/siswa/{id}/{idmapel}/deletenilai','SiswaController@deletenilai');
    route::resource('/pengumuman','PengumumanController');  

});

// cetak
Route::group(['middleware'=>'auth','checkrole:admin,siswa'],function(){
    route::get('/siswa/{id}/cetak_rapor_pdf','SiswaController@cetak_rapor_pdf')->name('siswa.cetak_rapor_pdf');
});

// siswa
Route::group(['middleware'=>['auth','checkrole:siswa']],function(){
    route::get('/profil','SiswaController@profilsaya')->name('profilsaya');

});
// guru
Route::group(['middleware'=>['auth','checkrole:guru']],function(){
    route::get('/profil/guru','GuruController@profilguru')->name('profilguru');
    route::get('/jadwalsaya/{idguru}','GuruController@jadwalGuru')->name('jadwalGuru');
});

// dashboard
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');



//jadwal
Route::group(['middleware'=>['auth','checkrole:guru,admin,siswa']],function(){
    route::resource('/jadwal','JadwalController');
});

// changepassword
Route::get('change-password', 'ChangePasswordController@index')->name('changepassword');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

