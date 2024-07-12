<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliverySlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('delivery_slots')->delete();

        \DB::table('delivery_slots')->insert(array(
            array('id' => '9a4d6603-f8b6-45b0-a3d3-b76dd5d1c271', 'city_id' => '32', 'start_time' => '08:00:00', 'end_time' => '11:00:00', 'active_status' => '1', 'deleted_at' => NULL, 'created_at' => '2023-10-06 06:02:26', 'updated_at' => '2023-10-06 06:02:26'),
            array('id' => '9a4d6603-fb70-4a96-a70c-1e4b0d7c3c46', 'city_id' => '32', 'start_time' => '12:00:00', 'end_time' => '14:00:00', 'active_status' => '1', 'deleted_at' => NULL, 'created_at' => '2023-10-06 06:02:26', 'updated_at' => '2023-10-06 06:02:26')
        ));
    }
}
