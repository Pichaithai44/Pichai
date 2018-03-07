<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
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
            ['name'=> 'admin'],
            ['name'=> 'user'],
            ['name'=> 'editor'],
        
        );

        foreach($list as $key => $l){
            DB::table('role')->insert([
                'id' => ($key + 1),
                'name' => $l['name'],
                'created_by' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'is_enable' => 'Y',
            ]);
        }
    }
}
