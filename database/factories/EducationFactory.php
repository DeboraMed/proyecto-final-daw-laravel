<?php

namespace Database\Factories;

use App\Enums\AcademicLevelEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'institution' => fake()->paragraph(),
            'qualification' => fake()->paragraph(),
            'completion_date' => fake()->date(),
            'academic_level' => fake()->randomElement(AcademicLevelEnum::cases())->value,
        ];
    }
}
