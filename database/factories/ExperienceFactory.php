<?php

namespace Database\Factories;

use App\Enums\ExperienceLevelEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => fake()->paragraph(),
            'description' => fake()->paragraph(),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'level' => fake()->randomElement(ExperienceLevelEnum::cases())->value,
        ];
    }
}
