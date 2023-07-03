<?php

namespace Modules\FleetService\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\FleetService\Entities\VehicleType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }
}

