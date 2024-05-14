<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vacancy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        // Forzamos unas credenciales especificas para uno de los usuarios
        $first_user = User::first();
        $first_user->name = 'User Test';
        $first_user->email = 'test@example.com';
        $first_user->password = Hash::make('test_password');
        $first_user->save();

        Education::factory(10)->create();
        Experience::factory(10)->create();
        Project::factory(10)->create();
        Vacancy::factory(10)->create();
    }
}
