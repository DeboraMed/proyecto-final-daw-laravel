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
        $instituciones = ['Universidad', 'Colegio', 'Instituto'];

        return [
            'institution' => $instituciones[array_rand($instituciones)] . ' de ' . fake()->city(),
            'qualification' => ucwords(fake()->words(2, true)),
            'completion_date' => fake()->date(),
            'academic_level' => fake()->randomElement(AcademicLevelEnum::cases())->value,
        ];
    }
}
