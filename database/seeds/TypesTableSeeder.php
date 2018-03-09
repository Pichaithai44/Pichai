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
            ['id' => 6,'name' => 'N0'],
            ['id' => 7,'name' => 'P0'],
            ['id' => 8,'name' => 'P0/P1'],
            ['id' => 9,'name' => 'M0'],
            ['id' => 10,'name' => 'T5'],
            ['id' => 11,'name' => 'Y3'],
            ['id' => 12,'name' => 'T6'],
            ['id' => 13,'name' => 'T3'],
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
