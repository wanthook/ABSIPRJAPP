<?php
$ext    = '';
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

Route::group(['middleware' => ['web']], function () use ($ext){
    Route::get('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
    Route::post('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@postLogin']);
});

Route::group(['middleware' => ['web','auth']], function ()  use ($ext){
    Route::get('/', ['as' => 'home.root','uses' => 'HomeController@index']);    
    Route::get('dashboard'.$ext, ['as' => 'home.dashboard','uses' => 'HomeController@dashboard']);
    
    /*
     * Route buat alasan
     */
    Route::get('alasan'.$ext,                ['as' => 'alasan.tabel','uses'  => 'AlasanController@show']);
    Route::post('alasan'.$ext,               ['as' => 'alasan.tabel','uses'  => 'AlasanController@dataTables']);
    Route::get('alasan/tambah'.$ext,         ['as' => 'alasan.tambah','uses' => 'AlasanController@create']);
    Route::post('alasan/tambah'.$ext,        ['as' => 'alasan.tambah','uses' => 'AlasanController@save']);
    Route::get('alasan/{id}/ubah'.$ext,      ['as' => 'alasan.ubah','uses'   => 'AlasanController@edit']);
    Route::patch('alasan/{id}/ubah'.$ext,    ['as' => 'alasan.ubah','uses'   => 'AlasanController@update']);
    Route::patch('alasan/{id}/hapus'.$ext,   ['as' => 'alasan.hapus','uses'   => 'AlasanController@softdelete']);
    
    /*
     * Route buat divisi
     */
    Route::get('divisi'.$ext,                ['as' => 'divisi.tabel','uses'  => 'DivisiController@show']);
    Route::post('divisi'.$ext,               ['as' => 'divisi.tabel','uses'  => 'DivisiController@dataTables']);
    Route::get('divisi/tambah'.$ext,         ['as' => 'divisi.tambah','uses' => 'DivisiController@create']);
    Route::post('divisi/tambah'.$ext,        ['as' => 'divisi.tambah','uses' => 'DivisiController@save']);
    Route::get('divisi/{id}/ubah'.$ext,      ['as' => 'divisi.ubah','uses'   => 'DivisiController@edit']);
    Route::patch('divisi/{id}/ubah'.$ext,    ['as' => 'divisi.ubah','uses'   => 'DivisiController@update']);
    Route::patch('divisi/{id}/hapus'.$ext,   ['as' => 'divisi.hapus','uses'   => 'DivisiController@softdelete']);
    //for select2
    Route::post('divisi/selectdua'.$ext,        ['as' => 'divisi.selectdua','uses' => 'DivisiController@selectdua']);
    
    /*
     * Route buat jabatan
     */
    Route::get('jabatan'.$ext,                ['as' => 'jabatan.tabel','uses'  => 'JabatanController@show']);
    Route::post('jabatan'.$ext,               ['as' => 'jabatan.tabel','uses'  => 'JabatanController@dataTables']);
    Route::get('jabatan/tambah'.$ext,         ['as' => 'jabatan.tambah','uses' => 'JabatanController@create']);
    Route::post('jabatan/tambah'.$ext,        ['as' => 'jabatan.tambah','uses' => 'JabatanController@save']);
    Route::get('jabatan/{id}/ubah'.$ext,      ['as' => 'jabatan.ubah','uses'   => 'JabatanController@edit']);
    Route::patch('jabatan/{id}/ubah'.$ext,    ['as' => 'jabatan.ubah','uses'   => 'JabatanController@update']);
    Route::patch('jabatan/{id}/hapus'.$ext,   ['as' => 'jabatan.hapus','uses'   => 'JabatanController@softdelete']);
    //for select2
    Route::post('jabatan/selectdua'.$ext,        ['as' => 'jabatan.selectdua','uses' => 'JabatanController@selectdua']);
    
    
    /*
     * Route buat libur
     */
    Route::get('libur'.$ext,                ['as' => 'libur.tabel','uses'  => 'LiburController@show']);
    Route::post('libur'.$ext,               ['as' => 'libur.tabel','uses'  => 'LiburController@dataTables']);
    Route::get('libur/tambah'.$ext,         ['as' => 'libur.tambah','uses' => 'LiburController@create']);
    Route::post('libur/tambah'.$ext,        ['as' => 'libur.tambah','uses' => 'LiburController@save']);
    Route::get('libur/{id}/ubah'.$ext,      ['as' => 'libur.ubah','uses'   => 'LiburController@edit']);
    Route::patch('libur/{id}/ubah'.$ext,    ['as' => 'libur.ubah','uses'   => 'LiburController@update']);
    Route::patch('libur/{id}/hapus'.$ext,   ['as' => 'libur.hapus','uses'   => 'LiburController@softdelete']);
    
    /*
     * Route buat perusahaan
     */
    Route::get('perusahaan'.$ext,                ['as' => 'perusahaan.tabel','uses'  => 'PerusahaanController@show']);
    Route::post('perusahaan'.$ext,               ['as' => 'perusahaan.tabel','uses'  => 'PerusahaanController@dataTables']);
    Route::get('perusahaan/tambah'.$ext,         ['as' => 'perusahaan.tambah','uses' => 'PerusahaanController@create']);
    Route::post('perusahaan/tambah'.$ext,        ['as' => 'perusahaan.tambah','uses' => 'PerusahaanController@save']);
    Route::get('perusahaan/{id}/ubah'.$ext,      ['as' => 'perusahaan.ubah','uses'   => 'PerusahaanController@edit']);
    Route::patch('perusahaan/{id}/ubah'.$ext,    ['as' => 'perusahaan.ubah','uses'   => 'PerusahaanController@update']);
    Route::patch('perusahaan/{id}/hapus'.$ext,   ['as' => 'perusahaan.hapus','uses'   => 'PerusahaanController@softdelete']);
    //for select2
    Route::post('perusahaan/selectdua'.$ext,     ['as' => 'perusahaan.selectdua','uses' => 'PerusahaanController@selectdua']);
    
    /*
     * Route buat agama
     */
    Route::get('agama'.$ext,                ['as' => 'agama.tabel','uses'  => 'AgamaController@show']);
    Route::post('agama'.$ext,               ['as' => 'agama.tabel','uses'  => 'AgamaController@dataTables']);
    Route::get('agama/tambah'.$ext,         ['as' => 'agama.tambah','uses' => 'AgamaController@create']);
    Route::post('agama/tambah'.$ext,        ['as' => 'agama.tambah','uses' => 'AgamaController@save']);
    Route::get('agama/{id}/ubah'.$ext,      ['as' => 'agama.ubah','uses'   => 'AgamaController@edit']);
    Route::patch('agama/{id}/ubah'.$ext,    ['as' => 'agama.ubah','uses'   => 'AgamaController@update']);
    Route::patch('agama/{id}/hapus'.$ext,   ['as' => 'agama.hapus','uses'   => 'AgamaController@softdelete']);
    //for select2
    Route::post('agama/selectdua'.$ext,        ['as' => 'agama.selectdua','uses' => 'AgamaController@selectdua']);
    
    /*
     * Route buat karyawan
     */
    Route::get('karyawan'.$ext,                ['as' => 'karyawan.tabel','uses'  => 'KaryawanController@show']);
    Route::post('karyawan'.$ext,               ['as' => 'karyawan.tabel','uses'  => 'KaryawanController@dataTables']);
    Route::post('karyawan/log'.$ext,           ['as' => 'karyawan.tabellog','uses'  => 'KaryawanController@logDataTables']);
    Route::get('karyawan/tambah'.$ext,         ['as' => 'karyawan.tambah','uses' => 'KaryawanController@create']);
    Route::post('karyawan/tambah'.$ext,        ['as' => 'karyawan.tambah','uses' => 'KaryawanController@save']);
    Route::get('karyawan/upload'.$ext,         ['as' => 'karyawan.upload','uses' => 'KaryawanController@upload']);
    Route::post('karyawan/upload'.$ext,        ['as' => 'karyawan.upload','uses' => 'KaryawanController@saveupload']);
    Route::get('karyawan/{id}/ubah'.$ext,      ['as' => 'karyawan.ubah','uses'   => 'KaryawanController@edit']);
    Route::patch('karyawan/{id}/ubah'.$ext,    ['as' => 'karyawan.ubah','uses'   => 'KaryawanController@update']);
    Route::patch('karyawan/{id}/hapus'.$ext,   ['as' => 'karyawan.hapus','uses'   => 'KaryawanController@softdelete']);
    Route::get('karyawan/{kode}/pp'.$ext,      ['as' => 'karyawan.pp', function ($kode)
    {
        $path = storage_path("uploads/profiles/") . $kode.".tpk";
        $response = Response::make(File::get($path), 200);
        $response->header("Content-Type", File::mimeType($path));
        return $response;
    }]);
    
    Route::get('karyawan/{kode}/logdownload'.$ext, ['as' => 'karyawan.logdownload', function ($kode)
    {
        $path = storage_path("filelog/karyawanupload/") . $kode.".xlsx";
        $response = Response::make(File::get($path), 200);
        $response->header("Content-Type", File::mimeType($path));
        return $response;
    }]);
    
    /*
     * Route buat waktu
     */
    Route::get('waktu'.$ext,                ['as' => 'waktu.tabel','uses'  => 'WaktuController@show']);
    Route::post('waktu'.$ext,               ['as' => 'waktu.tabel','uses'  => 'WaktuController@dataTables']);
    Route::get('waktu/tambah'.$ext,         ['as' => 'waktu.tambah','uses' => 'WaktuController@create']);
    Route::post('waktu/tambah'.$ext,        ['as' => 'waktu.tambah','uses' => 'WaktuController@save']);
    Route::get('waktu/{id}/ubah'.$ext,      ['as' => 'waktu.ubah','uses'   => 'WaktuController@edit']);
    Route::patch('waktu/{id}/ubah'.$ext,    ['as' => 'waktu.ubah','uses'   => 'WaktuController@update']);
    Route::patch('waktu/{id}/hapus'.$ext,   ['as' => 'waktu.hapus','uses'   => 'WaktuController@softdelete']);
    //for select2
    Route::post('waktu/selectdua'.$ext,        ['as' => 'waktu.selectdua','uses' => 'WaktuController@selectdua']);
    
    /*
     * Route buat jadwal Kerja
     */
    Route::get('jadwal'.$ext,                ['as' => 'jadwal.tabel','uses'  => 'JadwalController@show']);
    Route::post('jadwal'.$ext,               ['as' => 'jadwal.tabel','uses'  => 'JadwalController@dataTables']);
    Route::get('jadwal/tambah/dayshift'.$ext,['as' => 'jadwal.tambah.dayshift','uses' => 'JadwalController@create_dayshift']);
    Route::post('jadwal/tambah/dayshift'.$ext,['as' => 'jadwal.tambah.dayshift','uses' => 'JadwalController@save_dayshift']);
    Route::patch('jadwal/ubah/{id}/dayshift'.$ext,    ['as' => 'jadwal.ubah.dayshift','uses'   => 'JadwalController@update_dayshift']);
    Route::get('jadwal/ubah/{id}/dayshift'.$ext,      ['as' => 'jadwal.ubah.dayshift','uses'   => 'JadwalController@edit_dayshift']);
    
    Route::get('jadwal/tambah/shift'.$ext,['as' => 'jadwal.tambah.shift','uses' => 'JadwalController@create_shift']);
    Route::post('jadwal/tambah/shift'.$ext,['as' => 'jadwal.tambah.shift','uses' => 'JadwalController@save_shift']);
    Route::patch('jadwal/ubah/{id}/shift'.$ext,    ['as' => 'jadwal.ubah.shift','uses'   => 'JadwalController@update_shift']);
    Route::get('jadwal/ubah/{id}/shift'.$ext,      ['as' => 'jadwal.ubah.shift','uses'   => 'JadwalController@edit_shift']);
    
    Route::patch('jadwal/{id}/hapus'.$ext,   ['as' => 'jadwal.hapus','uses'   => 'JadwalController@softdelete']);
    //for select2
    Route::post('jadwal/selectdua'.$ext,        ['as' => 'jadwal.selectdua','uses' => 'JadwalController@selectdua']);
    
});
