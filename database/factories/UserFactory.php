<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Developer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userTypesArray = [
            Company::class,
            Developer::class,
        ]; // Add new noteables here as we make them
        $randomUserType = fake()->randomElement($userTypesArray);
        $userable = $randomUserType::factory()->create();

        if($randomUserType == Developer::class) {
            $name = fake()->name();
            $files = File::files('public/storage/examples/developers');
            $randomFile = 'examples/developers/' . $files[array_rand($files)]->getFilename();
        }
        else {
            $name = ucwords(fake()->words(2, true));
            $files = File::files('public/storage/examples/companies');
            $randomFile = 'examples/companies/' . $files[array_rand($files)]->getFilename();
        }


        return [
            'name' => $name,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'description' => fake()->paragraph(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'avatar' => $randomFile,
            'userable_type' => $randomUserType,
            'userable_id' => $userable->id,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
