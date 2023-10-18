<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array(
            array('id' => '984583db-2436-4893-b4b7-cb2bc2aea27b', 'role_name' => 'Super Admin', 'description' => 'It have access to everything', 'is_active' => '1', 'created_at' => '2023-01-20 19:35:23', 'updated_at' => '2023-05-08 07:33:57'),
            array('id' => '984583f9-6f87-4b46-bb33-1474a39e2ca8', 'role_name' => 'Admin', 'description' => 'It have access to everything', 'is_active' => '1', 'created_at' => '2023-01-20 19:35:43', 'updated_at' => '2023-01-20 19:35:43'),

            array('id' => '984581a2-c5a4-4a2c-8db8-41d130706042', 'role_name' => 'Operation Manager', 'description' => NULL, 'is_active' => '1', 'created_at' => '2023-05-08 07:37:05', 'updated_at' => '2023-05-08 07:37:05'),
            array('id' => '991dc542-0a4f-4e7a-8b86-a5fd891b5sh3', 'role_name' => 'Finance Manager', 'description' => NULL, 'is_active' => '1', 'created_at' => '2023-05-08 07:37:05', 'updated_at' => '2023-05-08 07:37:05'),
            array('id' => '991dc542-0a4f-4e7a-8b86-a5fd891bmd8d', 'role_name' => 'Finance Employee', 'description' => NULL, 'is_active' => '1', 'created_at' => '2023-05-08 07:37:05', 'updated_at' => '2023-05-08 07:37:05'),
            array('id' => '991dc542-0a4f-4e7a-8b86-a5fd891bsnmf', 'role_name' => 'Fleet Manager', 'description' => NULL, 'is_active' => '1', 'created_at' => '2023-05-08 07:37:05', 'updated_at' => '2023-05-08 07:37:05'),
            array('id' => '991dc542-0a4f-4e7a-8b86-a5fd891b648d', 'role_name' => 'Fleet Employee', 'description' => NULL, 'is_active' => '1', 'created_at' => '2023-05-08 07:37:05', 'updated_at' => '2023-05-08 07:37:05'),
            array('id' => '991dc524-f814-4625-a9c7-72b7b6cc4ed4', 'role_name' => 'Customer Support Manager', 'description' => NULL, 'is_active' => '1', 'created_at' => '2023-05-08 07:36:46', 'updated_at' => '2023-05-08 07:36:46'),
            array('id' => '991dc524-f814-4625-a9c7-72b7b6s4ged4', 'role_name' => 'Customer Support Employee', 'description' => NULL, 'is_active' => '1', 'created_at' => '2023-05-08 07:36:46', 'updated_at' => '2023-05-08 07:36:46'),

            array('id' => '9959f101-265e-47cd-8d70-2920aa972838', 'role_name' => 'Business Admin', 'description' => NULL, 'is_active' => '1', 'created_at' => '2023-06-07 05:29:05', 'updated_at' => '2023-06-07 05:35:21'),
            array('id' => '991dc542-0a4f-4e7a-8b86-a5fd891bsbd5', 'role_name' => 'Business Manager', 'description' => NULL, 'is_active' => '1', 'created_at' => '2023-05-08 07:37:05', 'updated_at' => '2023-05-08 07:37:05'),
        ));
    }
}
