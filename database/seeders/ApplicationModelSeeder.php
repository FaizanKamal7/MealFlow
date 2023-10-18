<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicationModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('application_models')->delete();

        \DB::table('application_models')->insert(array(
            array('id' => '1948f28a-97e7-11ed-b4bc-f8281997de10', 'model_name' => 'Users', 'app_id' => '04b1c75b-97e7-11ed-b4bc-f8281997de10', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f24f89-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Appreciation', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f26762-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Attendance', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f2c44b-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Awards', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f2f0bf-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Banks', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f303d2-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Deductions', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f330da-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Departments', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f343cc-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Designation', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f35464-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Employee Departments', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f361d7-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Employee Media', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f36e91-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Employees', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f37c5e-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Employee Salary', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f388c9-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Events', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f39519-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Expense Reclaim', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f3a21e-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Leave Application', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f3ae63-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Leave Policy', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f3at54-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'HR', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f3ba6c-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Leave Policy Record', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f3c73e-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Leave Type', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f3d35e-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'OverTime', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f3df50-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Payroll', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f3ef6a-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Taxes', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f3fde4-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Team Members', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f40abe-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Teams', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82f4192b-e807-11ed-a8cd-ecf4bb29c0c8', 'model_name' => 'Timesheets', 'app_id' => 'cb503f1c-f54b-11ed-a20b-283a4d1eea26', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '894b9364-98f8-11ed-974e-f8281997de10', 'model_name' => 'Permissions', 'app_id' => '04b1c75b-97e7-11ed-b4bc-f8281997de10', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '894bc786-98f8-11ed-974e-f8281997de10', 'model_name' => 'Roles', 'app_id' => '04b1c75b-97e7-11ed-b4bc-f8281997de10', 'created_at' => NULL, 'updated_at' => NULL)
        ));
    }
}
