<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('departments')->delete();

        \DB::table('departments')->insert(array(
            array('id' => '984583db-2436-4893-b4b7-hdf372aea27b', 'department_name' => 'Customer Support', 'status' => 'active', 'created_at' => '2023-01-20 19:35:23', 'updated_at' => '2023-05-08 07:33:57'),
            array('id' => '984583f9-6f87-4b46-bb33-sh63139e2ca8', 'department_name' => 'Finance', 'status' => 'active', 'created_at' => '2023-01-20 19:35:43', 'updated_at' => '2023-01-20 19:35:43'),
        ));
    }
}
