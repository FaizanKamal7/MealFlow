<?php

namespace Modules\HRManagement\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\HRManagement\Entities\Designations;
use Modules\HRManagement\Entities\LeavePolicy;

class EmployeesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\HRManagement\Entities\Employees::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'company_email_address' => $this->faker->unique()->safeEmail,
            'personal_email_address' => $this->faker->unique()->safeEmail,
            'company_phone_number' => $this->faker->phoneNumber,
            'personal_phone_number' => $this->faker->phoneNumber,
            'picture' => $this->faker->imageUrl(200, 200),
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'marital_status' => $this->faker->randomElement(['Single', 'Married']),
            'hire_date' => $this->faker->date,
            'probation_period_start' => $this->faker->date,
            'probation_period_end' => $this->faker->date,
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'employee_type' => $this->faker->randomElement(['Full-time', 'Part-time']),
            'contract_start_date' => $this->faker->date,
            'contract_end_date' => $this->faker->date,
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'designation_id' => function () {
                return Designations::factory()->create()->id;
            },
            'leave_policy_id' => function () {
                return LeavePolicy::factory()->create()->id;
            },
        ];
    }
}

