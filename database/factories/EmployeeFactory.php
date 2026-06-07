<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'nik' => 'EMP' . fake()->unique()->numberBetween(1000, 9999),
            'department' => fake()->randomElement([
                'IT',
                'HRD',
                'Finance',
                'Marketing'
            ]),
            'position' => fake()->jobTitle(),
            'status' => fake()->randomElement([
                'aktif',
                'nonaktif'
            ]),
            'joined_at' => fake()->date(),
        ];
    }
}