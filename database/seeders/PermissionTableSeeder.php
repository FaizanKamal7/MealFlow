<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert(array(
            array('id' => '98458166-a2c5-46f7-b970-3bd00e4a0bb2', 'name' => 'Add', 'codename' => 'add_permission', 'is_active' => '1', 'model_id' => '894b9364-98f8-11ed-974e-f8281997de10', 'created_at' => '2023-01-20 19:28:31', 'updated_at' => '2023-01-20 19:28:31'),
            array('id' => '984581a2-c5a4-4a2c-8db8-41d130706042', 'name' => 'View', 'codename' => 'view_permissions', 'is_active' => '1', 'model_id' => '894b9364-98f8-11ed-974e-f8281997de10', 'created_at' => '2023-01-20 19:29:10', 'updated_at' => '2023-01-20 19:29:10'),
            array('id' => '984581c5-b434-4dd6-9320-aa58bc96b34e', 'name' => 'Update', 'codename' => 'update_permission', 'is_active' => '1', 'model_id' => '894b9364-98f8-11ed-974e-f8281997de10', 'created_at' => '2023-01-20 19:29:33', 'updated_at' => '2023-01-20 19:29:33'),
            array('id' => '984581e9-4f05-4db5-ba83-b8d5e9bc673f', 'name' => 'Delete', 'codename' => 'delete_permission', 'is_active' => '1', 'model_id' => '894b9364-98f8-11ed-974e-f8281997de10', 'created_at' => '2023-01-20 19:29:57', 'updated_at' => '2023-01-20 19:29:57'),
            array('id' => '98458210-025a-44e1-8534-2645a970979b', 'name' => 'Add', 'codename' => 'add_role', 'is_active' => '1', 'model_id' => '894bc786-98f8-11ed-974e-f8281997de10', 'created_at' => '2023-01-20 19:30:22', 'updated_at' => '2023-01-20 19:30:22'),
            array('id' => '9845822f-d2fa-41ed-8ab9-e0b2db98f6b5', 'name' => 'Update', 'codename' => 'update_role', 'is_active' => '1', 'model_id' => '894bc786-98f8-11ed-974e-f8281997de10', 'created_at' => '2023-01-20 19:30:43', 'updated_at' => '2023-01-20 19:30:43'),
            array('id' => '98458257-49c4-4db1-8a03-b96290834228', 'name' => 'Delete', 'codename' => 'delete_role', 'is_active' => '1', 'model_id' => '894bc786-98f8-11ed-974e-f8281997de10', 'created_at' => '2023-01-20 19:31:09', 'updated_at' => '2023-01-20 19:31:09'),
            array('id' => '9845827f-91a6-443e-b933-96e2f57b7c55', 'name' => 'View', 'codename' => 'view_role', 'is_active' => '1', 'model_id' => '894bc786-98f8-11ed-974e-f8281997de10', 'created_at' => '2023-01-20 19:31:35', 'updated_at' => '2023-01-20 19:31:35'),
            array('id' => '984582a2-b9a0-4ce6-8d2c-389c4c8be004', 'name' => 'Add', 'codename' => 'add_user', 'is_active' => '1', 'model_id' => '1948f28a-97e7-11ed-b4bc-f8281997de10', 'created_at' => '2023-01-20 19:31:58', 'updated_at' => '2023-01-20 19:31:58'),
            array('id' => '984582c7-6b5c-4913-9b0d-29fe4ded35d1', 'name' => 'Edit', 'codename' => 'edit_user', 'is_active' => '1', 'model_id' => '1948f28a-97e7-11ed-b4bc-f8281997de10', 'created_at' => '2023-01-20 19:32:22', 'updated_at' => '2023-01-20 19:32:22'),
            array('id' => '984582ff-548b-4c0f-9726-463686cc05b5', 'name' => 'Update', 'codename' => 'update_user', 'is_active' => '1', 'model_id' => '1948f28a-97e7-11ed-b4bc-f8281997de10', 'created_at' => '2023-01-20 19:32:59', 'updated_at' => '2023-01-20 19:32:59'),
            array('id' => '9845841d-773c-4365-9de3-353503a2a2e5', 'name' => 'Delete', 'codename' => 'delete_user', 'is_active' => '1', 'model_id' => '1948f28a-97e7-11ed-b4bc-f8281997de10', 'created_at' => '2023-01-20 19:34:02', 'updated_at' => '2023-01-20 19:34:02'),
            array('id' => '98458397-e19d-42ab-b695-a1c44dc8776b', 'name' => 'View', 'codename' => 'view_users', 'is_active' => '1', 'model_id' => '1948f28a-97e7-11ed-b4bc-f8281997de10', 'created_at' => '2023-01-20 19:34:39', 'updated_at' => '2023-01-20 19:34:39'),
            array('id' => '98f83c45-5050-49ac-ba24-1ce0483759f2', 'name' => 'delete_temp', 'codename' => 'delete_temp', 'is_active' => '1', 'model_id' => '1948f28a-97e7-11ed-b4bc-f8281997de10', 'created_at' => '2023-04-19 15:48:24', 'updated_at' => '2023-04-19 15:48:24'),
        ));
    }
}
