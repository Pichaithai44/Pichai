<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelsTableSeeder extends Seeder
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
            ['id' => 1,'name' => 'TEA'],
            ['id' => 2,'name' => 'TEA-LHD'],
            ['id' => 3,'name' => 'TEA-HTR'],
            ['id' => 4,'name' => 'TEA(5DR)'],
            ['id' => 5,'name' => 'TRD'],
            ['id' => 6,'name' => 'TRO'],
            ['id' => 7,'name' => 'T8N'],
            ['id' => 8,'name' => 'T8N-LHD'],
            ['id' => 9,'name' => 'T2A'],
            ['id' => 10,'name' => 'T5L'],
            ['id' => 11,'name' => 'TEA-5DR'],
            ['id' => 12,'name' => 'T8N(LHD)'],
            ['id' => 13,'name' => 'T9A'],
        );
        foreach($list as $key => $l){
            DB::table('lkup_model')->insert([
                'id' => $l['id'],
                'name' => $l['name'],
                'created_by' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'is_enable' => 'Y',
            ]);
        }
    }
}
