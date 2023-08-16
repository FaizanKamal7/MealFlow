<?php

namespace Modules\HRManagement\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LeavePolicyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\HRManagement\Entities\LeavePolicy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'policy_name' => $this->faker->unique()->word,
        ];
    }
}

