<?php
use App\Http\Controllers\CashflowController;
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
// Dashbobard
Route::get('/','PageController@beranda');
Route::get('/beranda','PageController@beranda')->name('beranda');

// Login
Route::get('/login','AuthController@getLogin')->middleware('guest')->name('login');
Route::post('/login','AuthController@postLogin')->middleware('guest')->name('post-login');
Route::get('/profile','AuthController@profile')->middleware('auth')->name('profile');
Route::get('/edit-profile','AuthController@editProfile')->middleware('auth')->name('edit-profile');
Route::put('/update-profile','AuthController@updateProfile')->middleware('auth')->name('update-profile');
Route::get('/edit-password','AuthController@editPassword')->middleware('auth')->name('edit-password');
Route::patch('/update-password','AuthController@updatePassword')->middleware('auth')->name('update-password');
Route::get('logout','AuthController@logout')->middleware('auth')->name('logout');

// User
Route::get('/users/{user}/reset-password','UserController@resetPassword')->middleware('auth')->name('users.reset-password');
Route::put('/users/{user}/update-password','UserController@updatePassword')->middleware('auth')->name('users.update-password');
Route::resource('users','UserController')->middleware('auth');

// Route::get('/instansi','InstansiController@index')->name('instansi.index');
// Route::get('/instansi/{id}/edit','InstansiController@edit')->middleware('auth')->name('instansi.edit');
// Route::put('/instansi/{id}','InstansiController@update')->middleware('auth')->name('instansi.update');


// Transaksi
Route::get('/transaksi/cari','TransaksiController@cari')->middleware('auth')->name('transaksi.cari');
Route::get('/transaksi','TransaksiController@index')->name('transaksi.index');
Route::get('/transaksi/create','TransaksiController@createTransaksi')->middleware('auth')->name('transaksi.create');
Route::get('/transaksi/laporan','TransaksiController@laporan')->name('transaksi.laporan');
Route::get('/transaksi/laporan/download','TransaksiController@laporanPDF')->name('transaksi.download');
Route::resource('transaksi','TransaksiController')->except(['show','create'])->middleware('auth');

// Route::get('/piutang','PiutangController@index')->name('piutang.index');
// Route::get('/piutang/create','PiutangController@createPiutang')->middleware('auth')->name('piutang.create');
// Route::resource('piutang','PiutangController')->except(['show','create'])->middleware('auth');

Route::get('/operasional/cari','OperasionalController@cari')->middleware('auth')->name('operasional.cari');
Route::get('/operasional','OperasionalController@index')->name('operasional.index');
Route::get('/operasional/create','OperasionalController@createOperasional')->middleware('auth')->name('operasional.create');
Route::resource('operasional','OperasionalController')->except(['show','create'])->middleware('auth');

Route::get('/hutang/cari','HutangController@cari')->middleware('auth')->name('hutang.cari');
Route::get('/hutang','HutangController@index')->name('hutang.index');
Route::get('/hutang/create','HutangController@createHutang')->middleware('auth')->name('hutang.create');
Route::post('/hutang/pembayaran/{id}', 'HutangController@pembayaran')->middleware('auth')->name('hutang.pembayaran');
Route::resource('hutang','HutangController')->except(['show','create'])->middleware('auth');

// Cashflow
Route::get('/planning','PlanningController@index')->name('planning.index');
Route::get('/planning/create','PlanningController@createPlanning')->middleware('auth')->name('planning.create');
Route::resource('planning','PlanningController')->except(['show','create'])->middleware('auth');
Route::post('/planning/cari','PlanningController@cari')->middleware('auth')->name('planning.cari');

Route::get('/cashflow','CashflowController@index')->name('cashflow.index');
Route::resource('cashflow','CashflowController')->except(['show','create'])->middleware('auth');
Route::post('/cashflow/cari','CashflowController@cari')->middleware('auth')->name('cashflow.cari');

// Master
Route::get('/coa','COAController@index')->name('coa.index');
Route::get('/coa/create','COAController@createCOA')->middleware('auth')->name('coa.create');
Route::resource('coa','COAController')->except(['show','create'])->middleware('auth');

Route::get('/index','IndexController@index')->name('data_i');
Route::get('/index/create','IndexController@createIndex')->middleware('auth')->name('index.create');
Route::resource('index','IndexController')->except(['show','create'])->middleware('auth');

Route::get('/target','TargetController@index')->name('target.index');
Route::get('/target/create','TargetController@createTarget')->middleware('auth')->name('target.create');
Route::resource('target','TargetController')->except(['show','create'])->middleware('auth');