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
