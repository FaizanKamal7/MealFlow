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
        \DB::table('business_categories')->delete();

        \DB::table('business_categories')->insert(array(
            array(
                'id' => '984584e4-3579-sde3-a380-363ee669ad42', 'name' => 'Meal Delivery',
                'created_at' => '2023-10-17 05:01:42',
                'updated_at' => '2023-10-17 05:01:42',
            ),
            array(
                'id' => '9a4d6603-fb70-we32-a70c-1e4b0d7c3c46', 'name' => 'Grocery Delivery',
                'created_at' => '2023-10-17 05:01:42',
                'updated_at' => '2023-10-17 05:01:42',
            )


        ));
    }
}
