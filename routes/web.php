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
Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/signout', 'AuthController@getsignout')->name('getsignout.auth');
    Route::get('/', function () {return view('welcome');})->name('welcome');

    // ตั้งค่าระบบ
    Route::get('/settingsystem','SettingSystemController@index')->name('pages.settingsystem.index');

    // ปรับปรุงตั้งค่าระบบ
    Route::patch('/settingsystem','SettingSystemController@store')->name('pages.settingsystem.store');

    // ตั้งค่าผู้ใช้งาน
    Route::get('/settinguser','SettingUserController@index')->name('pages.settinguser.index');

    // ตั้งค่าผู้ใช้งาน หน้าเพิ่ม
    Route::get('/settinguser/create','SettingUserController@create')->name('pages.settinguser.create');

    // ตั้งค่าผู้ใช้งาน เพิ่ม
    Route::patch('/settinguser/create','SettingUserController@store')->name('pages.settinguser.store');

    // ตั้งค่าผู้ใช้งาน ปรับปรุง
    Route::get('/settinguser/edit/{id}','SettingUserController@update')->name('pages.settinguser.update');

    // จำนำของ
    Route::get('/pledge','PledgeController@index')->name('pages.pledge.index');

    // นำของเข้าระบบ วิว
    Route::get('/pledge/create','PledgeController@create')->name('pages.pledge.create');

    // นำของเข้าระบบ เพิ่ม
    Route::patch('/pledge/create','PledgeController@store')->name('pages.pledge.store');

    // ชำระค่างวด วิว
    Route::get('/pledge/edit/{id}','PledgeController@edit')->name('pages.pledge.edit');

    // ปรับปรุงชำระค่างวด 
    Route::patch('/pledge/edit/{id}','PledgeController@update')->name('pages.pledge.update');

    // นำของออกจากระบบ 
    Route::patch('/pledge/delete/{id}','PledgeController@destroy')->name('pages.pledge.destroy');
});

