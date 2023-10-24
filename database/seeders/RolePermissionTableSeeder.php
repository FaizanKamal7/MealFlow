<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('role_permissions')->delete();

        \DB::table('role_permissions')->insert(array(
            array('id' => '984583db-5e00-4860-b20c-489fcd2b67ec', 'role_id' => '984583db-2436-4893-b4b7-cb2bc2aea27b', 'permission_id' => '984581c5-b434-4dd6-9320-aa58bc96b34e', 'created_at' => '2023-01-20 19:35:23', 'updated_at' => '2023-01-20 19:35:23'),
            array('id' => '984583f9-832d-4fda-9d83-f2dd27adsda3', 'role_id' => '984583db-2436-4893-b4b7-cb2bc2aea27b', 'permission_id' => '98458166-a2c5-46f7-b970-3bd00e4a0bb2', 'created_at' => '2023-01-20 19:35:43', 'updated_at' => '2023-01-20 19:35:43'),
            array('id' => '9845841d-84f7-4f3c-ba4f-94c9fc6e1858', 'role_id' => '984583db-2436-4893-b4b7-cb2bc2aea27b', 'permission_id' => '984581a2-c5a4-4a2c-8db8-41d130706042', 'created_at' => '2023-01-20 19:36:06', 'updated_at' => '2023-01-20 19:36:06'),
            array('id' => '984583db-5e00-4860-b20c-489fcd2bsd35', 'role_id' => '984583db-2436-4893-b4b7-cb2bc2aea27b', 'permission_id' => '984581e9-4f05-4db5-ba83-b8d5e9bc673f', 'created_at' => '2023-01-20 19:35:23', 'updated_at' => '2023-01-20 19:35:23'),
            array('id' => '984583f9-832d-4fda-9d83-f2dd27ad3116', 'role_id' => '984583db-2436-4893-b4b7-cb2bc2aea27b', 'permission_id' => '98458166-a2c5-46f7-b970-3bd00e4a0bb2', 'created_at' => '2023-01-20 19:35:43', 'updated_at' => '2023-01-20 19:35:43'),
            array('id' => '9845841d-84f7-4f3c-ba4f-94c9fc6e2312', 'role_id' => '984583db-2436-4893-b4b7-cb2bc2aea27b', 'permission_id' => '9845822f-d2fa-41ed-8ab9-e0b2db98f6b5', 'created_at' => '2023-01-20 19:36:06', 'updated_at' => '2023-01-20 19:36:06'),

            array('id' => '984583db-5e00-4860-b20c-489fcd2bhs64', 'role_id' => '984583db-2436-4893-b4b7-cb2bc2aea27b', 'permission_id' => '98458397-e19d-42ab-b695-a1c44dc8776b', 'created_at' => '2023-01-20 19:35:23', 'updated_at' => '2023-01-20 19:35:23'),
            array('id' => '984583f9-832d-4fda-9d83-f2dd27addf44', 'role_id' => '984583db-2436-4893-b4b7-cb2bc2aea27b', 'permission_id' => '98458397-e19d-42ab-b695-a1c44dc8776b', 'created_at' => '2023-01-20 19:35:43', 'updated_at' => '2023-01-20 19:35:43'),
            array('id' => '9845841d-84f7-4f3c-ba4f-94c9fc6e3463', 'role_id' => '984583db-2436-4893-b4b7-cb2bc2aea27b', 'permission_id' => '984582ff-548b-4c0f-9726-463686cc05b5', 'created_at' => '2023-01-20 19:36:06', 'updated_at' => '2023-01-20 19:36:06'),
            array('id' => '984583db-5e00-4860-b20c-489fcd2bdf53', 'role_id' => '984583db-2436-4893-b4b7-cb2bc2aea27b', 'permission_id' => '984582c7-6b5c-4913-9b0d-29fe4ded35d1', 'created_at' => '2023-01-20 19:35:23', 'updated_at' => '2023-01-20 19:35:23'),
            array('id' => '984583f9-832d-4fda-9d83-f2dd27addf43', 'role_id' => '984583db-2436-4893-b4b7-cb2bc2aea27b', 'permission_id' => '984582a2-b9a0-4ce6-8d2c-389c4c8be004', 'created_at' => '2023-01-20 19:35:43', 'updated_at' => '2023-01-20 19:35:43'),
            array('id' => '9845841d-84f7-4f3c-ba4f-94c9fc6edf3s', 'role_id' => '984583db-2436-4893-b4b7-cb2bc2aea27b', 'permission_id' => '9845827f-91a6-443e-b933-96e2f57b7c55', 'created_at' => '2023-01-20 19:36:06', 'updated_at' => '2023-01-20 19:36:06'),

        ));
    }
}
