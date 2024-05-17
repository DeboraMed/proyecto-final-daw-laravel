<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\JobMatch;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class JobMatchController extends Controller
{
    public function index() {

        $developer = auth()->user()->userable;
        if(!$developer instanceof Developer)
            return response()->json(['message' => 'El usuario no es un desarrollador'], 403);

        $jobMatches = $developer->jobMatches()->with('vacancy')->get();
        return response()->json(['job_match' => $jobMatches], 200);
    }

    public function refreshMatches() {
        $developers = Developer::all();
        $vacancies = Vacancy::all();
        #TODO: Intentar actualizar solo los cambios.
        JobMatch::truncate();

        foreach ($developers as $developer) {
            foreach ($vacancies as $vacancy) {
                $jobMatch = $this->calculateMatchScore($developer, $vacancy);
                if ($jobMatch->score > 50) { // Umbral de coincidencia del 80%
                    $jobMatch->save();
                }
            }
        }

        return response()->json(['message' => 'Matchmaking realizado correctamente'], 200);
    }

    private function calculateMatchScore($developer, $vacancy) {
        // Implementa la lógica para calcular la coincidencia
        $score = 0;

        if($developer->contract_type == $vacancy->contract_type)
            $score+=40;
        if($developer->work_mode == $vacancy->work_mode)
            $score+=30;
        if($developer->schedule == $vacancy->schedule)
            $score+=30;

        $jobMatch = new JobMatch([
            'developer_id' => $developer->id,
            'vacancy_id' => $vacancy->id,
            'score' => $score,
            'notes' => 'Emparejamiento OK',
        ]);

        /*
        // Ejemplo básico de comparación de habilidades
        $developerSkills = json_decode($developer->skills);
        $requiredSkills = json_decode($job->required_skills);

        $commonSkills = array_intersect($developerSkills, $requiredSkills);
        $score = count($commonSkills) / count($requiredSkills);
        */
        // Puedes agregar más criterios como ubicación, tipo de empleo, etc.
        return $jobMatch;
    }
}
