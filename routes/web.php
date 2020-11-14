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

Auth::routes();

Route::get('/data-warga', 'HomeController@index')->name('home');
Route::get('/penambahan_kas', 'HomeController@penambahan_kas');
Route::get('/pengurangan_kas', 'HomeController@pengurangan_kas');
Route::get('/lengkapi_profil', 'HomeController@lengkapi_profil');
Route::post('/simpan_data_warga', 'HomeController@simpan_data_warga');
Route::get('/json', 'HomeController@json');
Route::post('/tambah_kas', 'HomeController@tambah_kas');
Route::post('/pengeluaran_kas', 'HomeController@pengeluaran_kas');
Route::get('/json_pemasukan', 'HomeController@json_pemasukan');
Route::get('/json_pengeluaran', 'HomeController@json_pengeluaran');
Route::get('/saksi/{id}', 'HomeController@saksi');
Route::get('/penerima/{id}', 'HomeController@penerima');
Route::get('/saksi_pengeluaran/{id}', 'HomeController@saksi_pengeluaran');
Route::get('/pengesah/{id}', 'HomeController@pengesah');
Route::get('/hapus-data-warga/{id}', 'HomeController@hapus_data_warga');
Route::get('/get/{id}', 'HomeController@get');


