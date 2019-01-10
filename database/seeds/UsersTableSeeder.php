<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //        
        $list = [
            [
                'first_name'=> 'super',
                'last_name'=> 'admin',
                'email'=> 'admin@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> null,
                'role_id'=> 1,//สิทธิใช้งาน
                'department_id'=> null,//
                'job_position_id'=> null,//ตำแหน่ง
                'created_by'=> null,//admins
            ]
        ];
        
        foreach($list as $key => $l){ 
            DB::table('users')->insert([
                'first_name' => $l['first_name'],
                'last_name' => $l['last_name'],
                'email' => $l['email'],
                'password' => $l['password'],
                'is_id' => $l['is_id'],
                'role_id' => $l['role_id'],
                'department_id' => $l['department_id'],
                'job_position_id' => $l['job_position_id'],
                'is_enable' => 'Y'
            ]);
        }
    }
}