<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', ['as' => 'home.root','uses' => 'HomeController@index']);    
    Route::get('dashboard', ['as' => 'home.dashboard','uses' => 'HomeController@dashboard']);
    
    /*
     * Route buat alasan
     */
    Route::get('alasan',                ['as' => 'alasan.tabel','uses'  => 'AlasanController@show']);
    Route::post('alasan',               ['as' => 'alasan.tabel','uses'  => 'AlasanController@dataTables']);
    Route::get('alasan/tambah',         ['as' => 'alasan.tambah','uses' => 'AlasanController@create']);
    Route::post('alasan/tambah',        ['as' => 'alasan.tambah','uses' => 'AlasanController@save']);
    Route::get('alasan/{id}/ubah',      ['as' => 'alasan.ubah','uses'   => 'AlasanController@edit']);
    Route::patch('alasan/{id}/ubah',    ['as' => 'alasan.ubah','uses'   => 'AlasanController@update']);
    Route::patch('alasan/{id}/hapus',   ['as' => 'alasan.hapus','uses'   => 'AlasanController@softdelete']);
    
    /*
     * Route buat divisi
     */
    Route::get('divisi',                ['as' => 'divisi.tabel','uses'  => 'DivisiController@show']);
    Route::post('divisi',               ['as' => 'divisi.tabel','uses'  => 'DivisiController@dataTables']);
    Route::get('divisi/tambah',         ['as' => 'divisi.tambah','uses' => 'DivisiController@create']);
    Route::post('divisi/tambah',        ['as' => 'divisi.tambah','uses' => 'DivisiController@save']);
    Route::get('divisi/{id}/ubah',      ['as' => 'divisi.ubah','uses'   => 'DivisiController@edit']);
    Route::patch('divisi/{id}/ubah',    ['as' => 'divisi.ubah','uses'   => 'DivisiController@update']);
    Route::patch('divisi/{id}/hapus',   ['as' => 'divisi.hapus','uses'   => 'DivisiController@softdelete']);
    //for select2
    Route::post('divisi/selectdua',        ['as' => 'divisi.selectdua','uses' => 'DivisiController@selectdua']);
    
    /*
     * Route buat jabatan
     */
    Route::get('jabatan',                ['as' => 'jabatan.tabel','uses'  => 'JabatanController@show']);
    Route::post('jabatan',               ['as' => 'jabatan.tabel','uses'  => 'JabatanController@dataTables']);
    Route::get('jabatan/tambah',         ['as' => 'jabatan.tambah','uses' => 'JabatanController@create']);
    Route::post('jabatan/tambah',        ['as' => 'jabatan.tambah','uses' => 'JabatanController@save']);
    Route::get('jabatan/{id}/ubah',      ['as' => 'jabatan.ubah','uses'   => 'JabatanController@edit']);
    Route::patch('jabatan/{id}/ubah',    ['as' => 'jabatan.ubah','uses'   => 'JabatanController@update']);
    Route::patch('jabatan/{id}/hapus',   ['as' => 'jabatan.hapus','uses'   => 'JabatanController@softdelete']);
    //for select2
    Route::post('jabatan/selectdua',        ['as' => 'jabatan.selectdua','uses' => 'JabatanController@selectdua']);
    
    
    /*
     * Route buat libur
     */
    Route::get('libur',                ['as' => 'libur.tabel','uses'  => 'LiburController@show']);
    Route::post('libur',               ['as' => 'libur.tabel','uses'  => 'LiburController@dataTables']);
    Route::get('libur/tambah',         ['as' => 'libur.tambah','uses' => 'LiburController@create']);
    Route::post('libur/tambah',        ['as' => 'libur.tambah','uses' => 'LiburController@save']);
    Route::get('libur/{id}/ubah',      ['as' => 'libur.ubah','uses'   => 'LiburController@edit']);
    Route::patch('libur/{id}/ubah',    ['as' => 'libur.ubah','uses'   => 'LiburController@update']);
    Route::patch('libur/{id}/hapus',   ['as' => 'libur.hapus','uses'   => 'LiburController@softdelete']);
    
    /*
     * Route buat perusahaan
     */
    Route::get('perusahaan',                ['as' => 'perusahaan.tabel','uses'  => 'PerusahaanController@show']);
    Route::post('perusahaan',               ['as' => 'perusahaan.tabel','uses'  => 'PerusahaanController@dataTables']);
    Route::get('perusahaan/tambah',         ['as' => 'perusahaan.tambah','uses' => 'PerusahaanController@create']);
    Route::post('perusahaan/tambah',        ['as' => 'perusahaan.tambah','uses' => 'PerusahaanController@save']);
    Route::get('perusahaan/{id}/ubah',      ['as' => 'perusahaan.ubah','uses'   => 'PerusahaanController@edit']);
    Route::patch('perusahaan/{id}/ubah',    ['as' => 'perusahaan.ubah','uses'   => 'PerusahaanController@update']);
    Route::patch('perusahaan/{id}/hapus',   ['as' => 'perusahaan.hapus','uses'   => 'PerusahaanController@softdelete']);
    //for select2
    Route::post('perusahaan/selectdua',        ['as' => 'perusahaan.selectdua','uses' => 'PerusahaanController@selectdua']);
    
    /*
     * Route buat agama
     */
    Route::get('agama',                ['as' => 'agama.tabel','uses'  => 'AgamaController@show']);
    Route::post('agama',               ['as' => 'agama.tabel','uses'  => 'AgamaController@dataTables']);
    Route::get('agama/tambah',         ['as' => 'agama.tambah','uses' => 'AgamaController@create']);
    Route::post('agama/tambah',        ['as' => 'agama.tambah','uses' => 'AgamaController@save']);
    Route::get('agama/{id}/ubah',      ['as' => 'agama.ubah','uses'   => 'AgamaController@edit']);
    Route::patch('agama/{id}/ubah',    ['as' => 'agama.ubah','uses'   => 'AgamaController@update']);
    Route::patch('agama/{id}/hapus',   ['as' => 'agama.hapus','uses'   => 'AgamaController@softdelete']);
    //for select2
    Route::post('agama/selectdua',        ['as' => 'agama.selectdua','uses' => 'AgamaController@selectdua']);
    
    /*
     * Route buat karyawan
     */
    Route::get('karyawan',                ['as' => 'karyawan.tabel','uses'  => 'KaryawanController@show']);
    Route::post('karyawan',               ['as' => 'karyawan.tabel','uses'  => 'KaryawanController@dataTables']);
    Route::get('karyawan/tambah',         ['as' => 'karyawan.tambah','uses' => 'KaryawanController@create']);
    Route::post('karyawan/tambah',        ['as' => 'karyawan.tambah','uses' => 'KaryawanController@save']);
    Route::get('karyawan/upload',         ['as' => 'karyawan.upload','uses' => 'KaryawanController@upload']);
    Route::post('karyawan/upload',        ['as' => 'karyawan.upload','uses' => 'KaryawanController@saveupload']);
    Route::get('karyawan/{id}/ubah',      ['as' => 'karyawan.ubah','uses'   => 'KaryawanController@edit']);
    Route::patch('karyawan/{id}/ubah',    ['as' => 'karyawan.ubah','uses'   => 'KaryawanController@update']);
    Route::patch('karyawan/{id}/hapus',   ['as' => 'karyawan.hapus','uses'   => 'KaryawanController@softdelete']);
});
