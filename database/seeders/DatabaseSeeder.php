<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Developer;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Technology;
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
        User::factory(50)->create();

        Company::all()->each(
            function ($company) {
                Vacancy::factory(5)->for($company)->create();
            });

        Developer::all()->each(
            function ($developer) {
                Project::factory(3)->for($developer)->create();
                Experience::factory(3)->for($developer)->create();
                Education::factory(3)->for($developer)->create();
            });

        $technologies = Technology::all();

        Vacancy::all()->each(
            function ($vacancy) use ($technologies) {
                $vacancy->technologies()->attach(
                    $technologies->random(2)->pluck('id')->toArray()
                );
            });

        Project::all()->each(
            function ($project) use ($technologies) {
                $project->technologies()->attach(
                    $technologies->random(3)->pluck('id')->toArray()
                );
            });

        Experience::all()->each(
            function ($experience) use ($technologies) {
                $experience->technologies()->attach(
                    $technologies->random(3)->pluck('id')->toArray()
                );
            });

        $user = Developer::first()->user;
        $user->email = 'dev@test.com';
        $user->password = Hash::make('dev_password');
        $user->save();

        $user = Company::first()->user;
        $user->email = 'comp@test.com';
        $user->password = Hash::make('comp_password');
        $user->save();
    }
}
