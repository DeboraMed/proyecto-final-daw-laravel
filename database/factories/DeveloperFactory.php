<?php

namespace Database\Factories;

use App\Enums\ContractTypeEnum;
use App\Enums\ScheduleEnum;
use App\Enums\SpecializationEnum;
use App\Enums\WorkModeEnum;
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
            'contract_type' => fake()->randomElement(ContractTypeEnum::cases())->value,
            'work_mode' => fake()->randomElement(WorkModeEnum::cases())->value,
            'schedule' => fake()->randomElement(ScheduleEnum::cases())->value,
            'specialization' => fake()->randomElement(SpecializationEnum::cases())->value,
            'github_url' => fake()->url()
        ];
    }
}
