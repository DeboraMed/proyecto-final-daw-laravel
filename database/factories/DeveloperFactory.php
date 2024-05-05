<?php

namespace Database\Factories;

use App\Enums\ContractTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Developer>
 */
class DeveloperFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'especialidad' => fake()->word(),
            'jornada' => fake()->word(),
            'modalidad' => fake()->word(),
            'contract-type' => fake()->randomElement(ContractTypeEnum::cases())->value,
            'github_url' => fake()->url()
        ];
    }
}
