<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        \DB::table('users')->insert(array(
            0 =>
            array(
                'id' => '984584e4-3579-40e1-a380-363ee669ad42',
                'name' => 'Admin User',
                'email' => 'admin@thelogx.com',
                'phone' => '971112233123',
                'email_verified_at' => null,
                'password' => '$2y$10$lAe5fgQHgePp6lu8MlGOuO68Pn6tRZjpB7lwotTc2vl7CrtVnpfwq',
                'is_active' => '1',
                'is_superuser' => '1',
                'last_login' => null,
                'remeber_token' => null,
                'created_at' => '2023-10-17 05:01:42',
                'updated_at' => '2023-10-17 05:01:42',
            ),
           
        ));
    }
}
