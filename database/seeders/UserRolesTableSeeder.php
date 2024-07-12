<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('user_roles')->delete();

        \DB::table('user_roles')->insert(array(
            array('id' => '984583db-2436-4893-b4b7-hdf372aea27b', 'role_id' => '984583db-2436-4893-b4b7-cb2bc2aea27b', 'user_id' => '984584e4-3579-40e1-a380-363ee669ad42', 'created_at' => '2023-01-20 19:35:23', 'updated_at' => '2023-05-08 07:33:57'),
            array('id' => '984583f9-6f87-4b46-bb33-sh63139e2ca8', 'role_id' => '984583db-2436-4893-b4b7-cb2bc2aea27b', 'user_id' => '984584e4-3579-40e1-a380-363ee669ad42', 'created_at' => '2023-01-20 19:35:43', 'updated_at' => '2023-01-20 19:35:43'),
        ));
    }
}
