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

// หน้าหลัก > ข้อมูลสมาชิก
Breadcrumbs::for('settinguser', function ($trail) {
    $trail->parent('home');
    $trail->push('ข้อมูลสมาชิก', route('pages.settinguser.index'));
});

// หน้าหลัก > ข้อมูลสมาชิก > เพิ่มผู้ใช้งาน
Breadcrumbs::for('create_settinguser', function ($trail) {
    $trail->parent('settinguser');
    $trail->push('เพิ่มผู้จำนำ', route('pages.settinguser.create'));
});

// หน้าหลัก > ข้อมูลสมาชิก > แก้ไขข้อมูลสมาชิก
Breadcrumbs::for('edit_settinguser', function ($trail, $user_id) {
    $trail->parent('settinguser');
    $trail->push('แก้ไขข้อมูลสมาชิก', route('pages.settinguser.edit',['id' => $user_id]));
});

// หน้าหลัก > ตั้งค่าผู้ใช้งาน
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('home');
    $trail->push('ตั้งค่าผู้ใช้งาน', route('pages.users.index'));
});

// หน้าหลัก > ตั้งค่าผู้ใช้งาน > เพิ่มผู้ใช้งาน
Breadcrumbs::for('create_user', function ($trail) {
    $trail->parent('users');
    $trail->push('เพิ่มผู้ใช้งาน', route('pages.users.create'));
});

// หน้าหลัก > ตั้งค่าผู้ใช้งาน > แก้ไขผู้ใช้งาน
Breadcrumbs::for('edit_user', function ($trail, $user_id) {
    $trail->parent('users');
    $trail->push('แก้ไขผู้ใช้งาน', route('pages.users.edit',['id' => $user_id]));
});

// หน้าหลัก > จำนำของ
Breadcrumbs::for('pledge', function ($trail) {
    $trail->parent('home');
    $trail->push('จำนำของ', route('pages.pledge.index'));
});

// หน้าหลัก > จำนำของ > นำของเข้าระบบ
Breadcrumbs::for('create_pledge', function ($trail) {
    $trail->parent('pledge');
    $trail->push('นำของเข้าระบบ', route('pages.pledge.create'));
});

// หน้าหลัก > จำนำของ > ชำระค่างวด
Breadcrumbs::for('edit_pledge', function ($trail, $pledge_id) {
    $trail->parent('pledge');
    $trail->push('ชำระค่างวด', route('pages.pledge.edit',['id' => $pledge_id]));
});