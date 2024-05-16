<?php

namespace App\Http\Controllers;

use App\Enums\ExperienceLevelEnum;
use App\Models\Developer;
use App\Models\Experience;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $developer = auth()->user()->userable;
        if(!$developer instanceof Developer)
            return response()->json(['message' => 'El usuario no es un desarrollador'], 403);

        $experiences = $developer->experiences()->with('technologies')->get();
        return response()->json(['experiences' => $experiences], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'company_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'level' => ['required', Rule::enum(ExperienceLevelEnum::class)],
            'technologies' => 'required|array|min:1',
            'technologies.*.name' => 'required|string|max:255',
        ]);

        $experience = auth()->user()->userable->experiences()->create([
            'company_name' => $request->company_name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'level' => $request->level
        ]);

        foreach ($request->technologies as $technology_name) {
            $technology = Technology::where('name', $technology_name['name'])->firstOrFail();
            $experience->technologies()->attach($technology->id);
        }

        return response()->json(['experience' => $experience], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        $user = auth()->user()->userable;
        $user_experience = $user->experiences()->with('technologies')->findOrFail($experience->id);

        return response()->json(['experience' => $user_experience], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        //
        $user = auth()->user()->userable;
        $user_experience = $user->experiences()->findOrFail($experience->id);

        $request->validate([
            'company_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'level' => ['required', Rule::enum(ExperienceLevelEnum::class)],
            'technologies' => 'required|array|min:1',
            'technologies.*.name' => 'required|string|max:255',
        ]);

        $user_experience->update([
            'company_name' => $request->company_name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'level' => $request->level
        ]);

        $user_experience->technologies()->detach();

        foreach ($request->technologies as $technology_name) {
            $technology = Technology::where('name', $technology_name)->firstOrFail();
            $user_experience->technologies()->attach($technology->id);
        }

        return response()->json(['experience' => $user_experience], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        $user = auth()->user()->userable;
        $user_experience = $user->experiences()->findOrFail($experience->id);

        $user_experience->delete();

        return response()->json(['message' => 'Experiencia eliminada con éxito'], 200);
    }
}
