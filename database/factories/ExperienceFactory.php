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
        $date1 = fake()->date();
        $date2 = fake()->date();

        return [
            'company_name' => ucwords(fake()->words(2, true, )),
            'description' => fake()->paragraph(),
            'start_date' => min($date1, $date2),
            'end_date' => max($date1, $date2),
            'level' => fake()->randomElement(ExperienceLevelEnum::cases())->value,
        ];
    }
}
