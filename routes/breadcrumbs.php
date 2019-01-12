<?php

// หน้าหลัก
Breadcrumbs::for('home', function ($trail) {
    $trail->push('หน้าหลัก', route('welcome'));
});

// หน้าหลัก > ตั้งค่าระบบ
Breadcrumbs::for('settingsystem', function ($trail) {
    $trail->parent('home');
    $trail->push('ตั้งค่าระบบ', route('pages.settingsystem.index'));
});

// หน้าหลัก > ตั้งค่าผู้ใช้งาน
Breadcrumbs::for('settinguser', function ($trail) {
    $trail->parent('home');
    $trail->push('ตั้งค่าผู้ใช้งาน', route('pages.settinguser.index'));
});

// หน้าหลัก > ตั้งค่าผู้ใช้งาน > เพิ่มผู้ใช้งาน
Breadcrumbs::for('create_user', function ($trail) {
    $trail->parent('settinguser');
    $trail->push('เพิ่มผู้ใช้งาน', route('pages.settinguser.create'));
});

// หน้าหลัก > ตั้งค่าผู้ใช้งาน > แก้ไขผู้ใช้งาน
Breadcrumbs::for('edit_user', function ($trail) {
    $trail->parent('settinguser');
    $trail->push('แก้ไขผู้ใช้งาน', route('pages.settinguser.edit'));
});

// // Home > Blog
// Breadcrumbs::for('blog', function ($trail) {
//     $trail->parent('home');
//     $trail->push('Blog', route('blog'));
// });

// // Home > Blog > [Category]
// Breadcrumbs::for('category', function ($trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category->id));
// });

// // Home > Blog > [Category] > [Post]
// Breadcrumbs::for('post', function ($trail, $post) {
//     $trail->parent('category', $post->category);
//     $trail->push($post->title, route('post', $post->id));
// });


//  // ตั้งค่าระบบ
//  Route::get('/settingsystem','SettingSystemController@index')->name('pages.settingsystem.index');

//  // ปรับปรุงตั้งค่าระบบ
//  Route::patch('/settingsystem','SettingSystemController@store')->name('pages.settingsystem.store');

//  // ตั้งค่าผู้ใช้งาน
//  Route::get('/settinguser','SettingUserController@index')->name('pages.settinguser.index');

//  // ตั้งค่าผู้ใช้งาน หน้าเพิ่ม
//  Route::get('/settinguser/create','SettingUserController@create')->name('pages.settinguser.create');

//  // ตั้งค่าผู้ใช้งาน เพิ่ม
//  Route::patch('/settinguser/create','SettingUserController@store')->name('pages.settinguser.store');

//  // ตั้งค่าผู้ใช้งาน หน้าปรับปรุง
//  Route::get('/settinguser/edit/{id}','SettingUserController@edit')->name('pages.settinguser.edit');

//  // ตั้งค่าผู้ใช้งาน ปรับปรุง
//  Route::patch('/settinguser/edit/{id}','SettingUserController@update')->name('pages.settinguser.update');

//  // ตั้งค่าผู้ใช้งาน ลบ
//  Route::patch('/settinguser/delete/{id}','SettingUserController@destroy')->name('pages.settinguser.destroy');

//  // จำนำของ
//  Route::get('/pledge','PledgeController@index')->name('pages.pledge.index');

//  // นำของเข้าระบบ วิว
//  Route::get('/pledge/create','PledgeController@create')->name('pages.pledge.create');

//  // นำของเข้าระบบ เพิ่ม
//  Route::patch('/pledge/create','PledgeController@store')->name('pages.pledge.store');

//  // ชำระค่างวด วิว
//  Route::get('/pledge/edit/{id}','PledgeController@edit')->name('pages.pledge.edit');

//  // ปรับปรุงชำระค่างวด 
//  Route::patch('/pledge/edit/{id}','PledgeController@update')->name('pages.pledge.update');

//  // นำของออกจากระบบ 
//  Route::patch('/pledge/delete/{id}','PledgeController@destroy')->name('pages.pledge.destroy');