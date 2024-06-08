<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'img_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'project_data' => 'required|json'
        ]);

        $projectData = json_decode($request->input('project_data'), true);

        $input_data = validator($projectData, [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'technologies' => 'required|array|min:1',
            'technologies.*.name' => 'required|string|max:255',
        ])->validate();

        $image = $request->file('img_url');

        $imagePath = Storage::disk('public')->put('storage', $image);
        $input_data['img_url'] = basename($imagePath);

        $project = auth()->user()->userable->projects()->create($input_data);

        foreach ($input_data['technologies'] as $technology_name) {
            $technology = Technology::where('name', $technology_name['name'])->firstOrFail();
            $project->technologies()->attach($technology->id);
        }

        $project->load('technologies');

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
            'technologies' => 'required|array|min:1',
            'technologies.*.name' => 'required|string|max:255',
        ]);

        $user_project->update([
            'title' => $request->title,
            'description' => $request->description,
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
