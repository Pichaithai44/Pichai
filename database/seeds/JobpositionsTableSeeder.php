<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobpositionsTableSeeder extends Seeder
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
            ['name' => 'supervisor'],
            ['name'=> 'staff']
    );
        foreach($list as $key => $l){
            DB::table('job_position')->insert([
                'id' => ( $key + 1 ),
                'name' => $l['name'],
                'created_by' => 1,
                'is_enable' => 'Y',
                'created_at' => date('Y-m-d h:i:s'),
            ]);
        }
    }
}
