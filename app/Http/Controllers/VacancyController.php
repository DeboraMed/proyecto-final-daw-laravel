<?php

namespace App\Http\Controllers;

use App\Enums\AcademicLevelEnum;
use App\Enums\ContractTypeEnum;
use App\Enums\ExperienceLevelEnum;
use App\Enums\ScheduleEnum;
use App\Enums\WorkModeEnum;
use App\Models\Company;
use App\Models\Developer;
use App\Models\Experience;
use App\Models\Technology;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $company = auth()->user()->userable;
        if(!$company instanceof Company)
            return response()->json(['message' => 'El usuario no es una empresa'], 403);

        $vacancies = $company->vacancies()->with('technologies')->get();
        return response()->json(['vacancies' => $vacancies], 200);
    }

    public function random()
    {
        //
        return response()->json(['vacancies' => Vacancy::with('company.user', 'technologies')->take(10)->inRandomOrder()->get()], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'date' => 'required|date',
            'contract_type' => ['required', Rule::enum(ContractTypeEnum::class)],
            'work_mode' => ['required', Rule::enum(WorkModeEnum::class)],
            'schedule' => ['required', Rule::enum(ScheduleEnum::class)],
            'academic_level' => ['required', Rule::enum(AcademicLevelEnum::class)],
            'technologies' => 'required|array|min:1',
            'technologies.*.name' => 'required|string|max:255',
        ]);

        $vacancy = auth()->user()->userable->vacancies()->create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'contract_type' => $request->contract_type,
            'work_mode' => $request->work_mode,
            'schedule' => $request->schedule,
            'academic_level' => $request->academic_level,
        ]);

        foreach ($request->technologies as $technology_name) {
            $technology = Technology::where('name', $technology_name['name'])->firstOrFail();
            $vacancy->technologies()->attach($technology->id);
        }

        return response()->json(['vacancy' => $vacancy], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacancy $vacancy)
    {
        $user = auth()->user()->userable;
        $user_vacancy = $user->vacancies()->with('technologies')->findOrFail($vacancy->id);

        return response()->json(['vacancy' => $user_vacancy], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vacancy $vacancy)
    {
        //
        $user = auth()->user()->userable;
        $user_vacancy = $user->vacancies()->findOrFail($vacancy->id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'date' => 'required|date',
            'contract_type' => ['required', Rule::enum(ContractTypeEnum::class)],
            'work_mode' => ['required', Rule::enum(WorkModeEnum::class)],
            'schedule' => ['required', Rule::enum(ScheduleEnum::class)],
            'academic_level' => ['required', Rule::enum(AcademicLevelEnum::class)],
            'technologies' => 'required|array|min:1',
            'technologies.*.name' => 'required|string|max:255',
        ]);

        $user_vacancy->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'contract_type' => $request->contract_type,
            'work_mode' => $request->work_mode,
            'schedule' => $request->schedule,
            'academic_level' => $request->academic_level,
        ]);

        $user_vacancy->technologies()->detach();

        foreach ($request->technologies as $technology_name) {
            $technology = Technology::where('name', $technology_name)->firstOrFail();
            $user_vacancy->technologies()->attach($technology->id);
        }

        return response()->json(['vacancy' => $user_vacancy], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacancy $vacancy)
    {
        $user = auth()->user()->userable;
        $user_vacancy = $user->vacancies()->findOrFail($vacancy->id);

        $user_vacancy->delete();

        return response()->json(['message' => 'Vacante eliminada con éxito'], 200);
    }
}
