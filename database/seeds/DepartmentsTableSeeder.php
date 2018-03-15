<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
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
            ['name' => 'production'],
            ['name' => 'pqa']
        );
        foreach($list as $key => $l){
            DB::table('department')->insert([
                'id' => ( $key + 1 ),
                'name' => $l['name'],
                'created_by' => 1,
                'is_enable' => 'Y',
                'created_at' => date('Y-m-d h:i:s')
            ]);
        }
    }
}
