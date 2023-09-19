<?php

namespace Modules\FleetService\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\HRManagement\Entities\Employees;

class DriverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\FleetService\Entities\Driver::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'license_number' => $this->faker->unique()->regexify('[A-Z0-9]{6}'),
            'is_available' => $this->faker->boolean(),
            // 'license_document' => $this->faker->file('/path/to/files', '/storage/app/documents', false),
            'license_issue_date' => $this->faker->date(),
            'license_expiry_date' => $this->faker->date(),
            'employee_id' => function () {
                return Employees::factory()->create()->id;
            },
        ];
    }
}

