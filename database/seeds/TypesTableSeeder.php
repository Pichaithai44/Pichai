<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesTableSeeder extends Seeder
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
            ['id' => 1,'name' => 'H0'],
            ['id' => 2,'name' => 'A0'],
            ['id' => 3,'name' => 'T0'],
            ['id' => 4,'name' => 'Y0'],
            ['id' => 5,'name' => 'T1'],
        );
        foreach($list as $key => $l){
            DB::table('lkup_type')->insert([
                'id' => $l['id'],
                'name' => $l['name'],
                'created_by' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'is_enable' => 'Y',
            ]);
        }
    }
}
