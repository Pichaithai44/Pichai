<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ProductionLinesTableSeeder::class);
        $this->call(JobpositionsTableSeeder::class);
        $this->call(ModelsTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(MaterialsTableSeeder::class);
        $this->call(LottagsTableSeeder::class);
        $this->call(ProcessTableSeeder::class);
        $this->call(LotTagProcessFilesTableSeeder::class);
    }
}
