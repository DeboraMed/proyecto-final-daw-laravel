<?php

namespace App\Http\Controllers;

use App\Enums\AcademicLevelEnum;
use App\Enums\ExperienceLevelEnum;
use App\Models\Developer;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EducationController extends Controller
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

        $education = $developer->education()->get();
        return response()->json(['education' => $education], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'institution' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'completion_date' => 'required|date',
            'academic_level' => ['required', Rule::enum(AcademicLevelEnum::class)],
        ]);

        $education = auth()->user()->userable->education()->create([
            'institution' => $request->institution,
            'qualification' => $request->qualification,
            'completion_date' => $request->completion_date,
            'academic_level' => $request->academic_level,
        ]);

        return response()->json(['education' => $education], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Education $education)
    {
        $user = auth()->user()->userable;
        $user_education = $user->education()->findOrFail($education->id);

        return response()->json(['education' => $user_education], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Education $education)
    {
        //
        $user = auth()->user()->userable;
        $user_education = $user->education()->findOrFail($education->id);

        $request->validate([
            'institution' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'completion_date' => 'required|date',
            'academic_level' => ['required', Rule::enum(AcademicLevelEnum::class)],
        ]);

        $user_education->update([
            'institution' => $request->institution,
            'qualification' => $request->qualification,
            'completion_date' => $request->completion_date,
            'academic_level' => $request->academic_level,
        ]);

        return response()->json(['education' => $user_education], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Education $education)
    {
        $user = auth()->user()->userable;
        $user_education = $user->education()->findOrFail($education->id);

        $user_education->delete();

        return response()->json(['message' => 'Formacion eliminada con éxito'], 200);
    }
}
