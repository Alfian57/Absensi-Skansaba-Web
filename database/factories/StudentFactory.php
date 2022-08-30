<?php

namespace Database\Factories;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nisn' => $this->faker->numerify('##########'),
            'nis' => $this->faker->numerify('#####'),
            'name' => $this->faker->unique->name(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'date_of_birth' => $this->faker->date(),
            'gender' => "0",
            'address' => $this->faker->address(),
            'grade_id' => 1,
            'entry_year' => "2022"
        ];
    }
}