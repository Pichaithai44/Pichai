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
        $list = array(
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
            ],
            [
                'first_name'=> 'วัณณะ',
                'last_name'=> 'จุมแพง',
                'email'=> '10909000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '10909',
                'role_id'=> 3,//สิทธิใช้งาน
                'department_id'=> 1,//
                'job_position_id'=> 1,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'ตรัยรัตน์',
                'last_name'=> 'หลงสุข',
                'email'=> '11421000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '11421',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=> 2,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'กฤษณะ',
                'last_name'=> 'คอนวิมาน',
                'email'=> '10625000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '10625',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=> 2,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'นนทวี',
                'last_name'=> 'แก้วโกย',
                'email'=> '11278000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '11278',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=> 3,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'วุฒิกร',
                'last_name'=> 'ทองมี',
                'email'=> '11809000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '11809',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=> 3,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'อาทิตย์',
                'last_name'=> 'ไชยสิทธิ์',
                'email'=> '11039000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '11039',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=> 2,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'พลวิวัฒ',
                'last_name'=> 'อัศวินจันลา',
                'email'=> '10824000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '10824',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=> 3,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'กมล',
                'last_name'=> 'ยะพลหา',
                'email'=> '11433000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '11433',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=> 3,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'วิชัย',
                'last_name'=> 'พวงศรี',
                'email'=> '10308000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '10308',
                'role_id'=> 3,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=> 1,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'กิตติพงษ์',
                'last_name'=> 'ยืนนาน',
                'email'=> '10392000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '10392',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=> 2,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'คริสต์',
                'last_name'=> 'สมทรัพย์',
                'email'=> '11405000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '11405',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=>3 ,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'ชุมพล',
                'last_name'=> 'แสนพวง',
                'email'=> '11479000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '11479',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=>3 ,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'จำนงค์',
                'last_name'=> 'ไชยศรีษะ',
                'email'=> '11060000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '11060',
                'role_id'=> 3,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=>1 ,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'อภิชาติ',
                'last_name'=> 'สุนทรสุข',
                'email'=> '10286000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '10286',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=>2 ,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'บัณฑิต',
                'last_name'=> 'ฉลวยศรี',
                'email'=> '11059000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '11059',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=>2 ,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'สราวุธ',
                'last_name'=> 'บรรลือเขต',
                'email'=> '11322000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '11322',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=> 3,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'สุธิศักดิ์',
                'last_name'=> 'แช่มช้อน',
                'email'=> '11309000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '11309',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=> 3,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'จตุพร',
                'last_name'=> 'ไวยรัตน์',
                'email'=> '10071000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '10071',
                'role_id'=> 3,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=>1 ,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'พสิษฐ์',
                'last_name'=> 'อัตรา',
                'email'=> '11072000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '11072',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=>2 ,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'สยุมภู',
                'last_name'=> 'ดีเส็ง',
                'email'=> '10581000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '10581',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=>3 ,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'กฤษณะ',
                'last_name'=> 'อรัญ',
                'email'=> '10485000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '10485',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=>1 ,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'วิทยา',
                'last_name'=> 'สุทธิชัยฤทธิ็',
                'email'=> '10285000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '10285',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=> 2,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'สุทิน',
                'last_name'=> 'นิลพัตร',
                'email'=> '10927000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '10927',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=> 2,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'สมจิตร',
                'last_name'=> 'มั่นคง',
                'email'=> '11438000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '11438',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=>3 ,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'วิรัช',
                'last_name'=> 'มาตเรียง',
                'email'=> '10795000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '10795',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=>3 ,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'ชัยยงค์',
                'last_name'=> 'วงทศรี',
                'email'=> '11049000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '11049',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=> 3,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'ชัยฤทธิ์',
                'last_name'=> 'จงธรรมจินดา',
                'email'=> '11498000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '11498',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=>3,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'ประยุทธ',
                'last_name'=> 'ราทะวงษ์',
                'email'=> '17002000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '17002',
                'role_id'=> 3,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=>1,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'ดารากร',
                'last_name'=> 'เจริญศรี',
                'email'=> '10141000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '10141',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=>3 ,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'พิสิษฐ์',
                'last_name'=> 'ศริพิทักษ์โชค',
                'email'=> '10578000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '10578',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=>2 ,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'ประทวน',
                'last_name'=> 'ม่วงประเสริฐ',
                'email'=> '10679000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '10679',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=>3 ,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'สำราญ',
                'last_name'=> 'คนพันธ์',
                'email'=> '10906000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '10906',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 1,//แผนก
                'job_position_id'=>2 ,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'กิตติรัตน์',
                'last_name'=> 'ดอกจันทร์',
                'email'=> '10082000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '10082',
                'role_id'=> 3,//สิทธิใช้งานs
                'department_id'=> 2,//แผนก
                'job_position_id'=>1 ,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'จันทร์รัตน์',
                'last_name'=> 'บุญร่วง',
                'email'=> '10566000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '10566',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 2,//แผนก
                'job_position_id'=>2 ,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ],
            [
                'first_name'=> 'เฉลิมขวัญ',
                'last_name'=> 'จดจำ',
                'email'=> '10547000@test.com',
                'password'=> bcrypt('password'),
                'is_id'=> '10547',
                'role_id'=> 2,//สิทธิใช้งาน
                'department_id'=> 2,//แผนก
                'job_position_id'=>2 ,//ตำแหน่ง
                'created_by'=> 1,//admin
            
            ], 
        );
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