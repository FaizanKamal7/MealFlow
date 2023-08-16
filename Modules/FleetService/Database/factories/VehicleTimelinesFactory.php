<?php

namespace Modules\FleetService\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\FleetService\Entities\Driver;
use Modules\FleetService\Entities\Vehicle;

class VehicleTimelinesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\FleetService\Entities\VehicleTimeline::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomVehicleId = Vehicle::pluck('id')->random();
        $randomDriverId = Driver::pluck('id')->random();
        $checkInTime = $this->faker->dateTimeThisMonth;
        $checkOutTime = $this->faker->dateTimeThisMonth($checkInTime);

        return [
            'vehicle_id' => $randomVehicleId,
            'driver_id' => $randomDriverId,
            'check_in_time' => $checkInTime,
            'check_out_time' => $checkOutTime,
            'device_details' => $this->faker->text,
            // 'checked_out_user' => $this->faker->name,
        ];
    }
}

