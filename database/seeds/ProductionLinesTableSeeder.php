<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductionLinesTableSeeder extends Seeder
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
            ['id' => 1,'name' => 'Line A'],
            ['id' => 2,'name'=> 'Line B'],
            ['id' => 3,'name'=> 'Line C'],
            ['id' => 4,'name'=> 'Line D'],
            ['id' => 5,'name'=> 'Line E'],
            ['id' => 6,'name'=> 'Line F'],
            ['id' => 7,'name'=> 'Line SP']
    );
        foreach($list as $key => $l){
            DB::table('lkup_production_line')->insert([
                'id' => $l['id'],
                'line_name' => $l['name'],
                'created_by' => 1,
                'is_enable' => 'Y',
                'created_at' => date('Y-m-d h:i:s')
            ]);
        }

    }
}
