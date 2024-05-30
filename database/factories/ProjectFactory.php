<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $files = File::files('public/storage/examples/projects');
        $randomFile = 'examples/projects/' . $files[array_rand($files)]->getFilename();

        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'img_url' => $randomFile,
        ];
    }
}
