<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialsTableSeeder extends Seeder
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
            ['id' => 1,'name' => 'JAC270F-45/45'],
            ['id' => 2,'name' => 'JAH270C-45/45'],
            ['id' => 3,'name' => 'JAC270C-45/45'],
            ['id' => 4,'name' => 'JSC270C'],
            ['id' => 5,'name' => 'JAC270C'],
            ['id' => 6,'name' => 'JSC590R'],
            ['id' => 7,'name' => 'JAC590R-45/45'],
            ['id' => 8,'name' => 'JSC590R-45/45'],
            ['id' => 9,'name' => 'JAC440W-45/45'],
            ['id' => 10,'name' => 'JAC780Y-45/45'],
            ['id' => 11,'name' => 'JAC270E-45/45'],
            ['id' => 12,'name' => 'JSC'],
            ['id' => 13,'name' => 'JSC270D'],
            ['id' => 14,'name' => 'JSC440W'],
            ['id' => 15,'name' => 'JSC780C'],
            ['id' => 16,'name' => 'JAC270D-45/45'],
       
        );
        foreach($list as $key => $l){
            DB::table('lkup_material')->insert([
                'id' => $l['id'],
                'name' => $l['name'],
                'created_by' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'is_enable' => 'Y',
            ]);
        }
    }
}
