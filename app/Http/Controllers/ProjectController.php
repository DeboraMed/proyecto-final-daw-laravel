<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;

class ProjectController extends Controller
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

        $projects = $developer->projects()->with('technologies')->get();
        return response()->json(['projects' => $projects], 200);
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
            'img_url' => 'required|url',
            'technologies' => 'required|array|min:1',
            'technologies.*.name' => 'required|string|max:255',
        ]);

        $project = auth()->user()->userable->projects()->create([
            'title' => $request->title,
            'description' => $request->description,
            'img_url' => $request->img_url
        ]);

        foreach ($request->technologies as $technology_name) {
            $technology = Technology::where('name', $technology_name['name'])->firstOrFail();
            $project->technologies()->attach($technology->id);
        }

        return response()->json(['project' => $project], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $user = auth()->user()->userable;
        $user_project = $user->projects()->with('technologies')->findOrFail($project->id); // Obtener el proyecto específico del usuario

        return response()->json(['project' => $user_project], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
        $user = auth()->user()->userable;
        $user_project = $user->projects()->findOrFail($project->id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'img_url' => 'required|url',
            'technologies' => 'required|array|min:1',
            'technologies.*.name' => 'required|string|max:255',
        ]);

        $user_project->update([
            'title' => $request->title,
            'description' => $request->description,
            'img_url' => $request->img_url
        ]);

        $user_project->technologies()->detach();

        foreach ($request->technologies as $technology_name) {
            $technology = Technology::where('name', $technology_name['name'])->firstOrFail();
            $user_project->technologies()->attach($technology->id);
        }

        return response()->json(['project' => $user_project], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $user = auth()->user()->userable;
        $user_project = $user->projects()->findOrFail($project->id);

        $user_project->delete();

        return response()->json(['message' => 'Proyecto eliminado con éxito'], 200);
    }
}
