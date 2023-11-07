<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('designations')->delete();

        \DB::table('designations')->insert(
            array(
                array(
                    'id' => '9a2da4ed-900c-4c1c-8bc6-65760708c043',
                    'name' => 'Fleet manager',
                    'parent_designation_id' => null,
                    'created_at' => '2023-09-20 06:11:52',
                    'updated_at' => '2023-09-20 06:11:52',
                ),
                array(
                    'id' => '9a2da533-6d32-4ce1-873a-097ffc73f9d5',
                    'name' => 'Driver',
                    'parent_designation_id' => null,
                    'created_at' => '2023-09-20 06:12:38',
                    'updated_at' => '2023-09-20 06:12:56',
                ),
            )
        );
    }
}
