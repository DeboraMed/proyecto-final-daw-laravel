<?php

namespace App\Http\Controllers;

use App\Enums\AcademicLevelEnum;
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

        $jobMatches = $developer->jobMatches()->with('vacancy.company.user')->orderBy('score','DESC')->get();
        return response()->json(['job_match' => $jobMatches], 200);
    }

    static public function refreshMatches() {
        $developers = Developer::all();
        $vacancies = Vacancy::all();
        #TODO: Intentar actualizar solo los cambios.
        JobMatch::truncate();

        foreach ($developers as $developer) {
            foreach ($vacancies as $vacancy) {
                $jobMatch = self::calculateMatchScore($developer, $vacancy);
                if ($jobMatch!=null && $jobMatch->score > 50) { // Umbral de coincidencia supera el 50%
                    $jobMatch->save();
                }
            }
        }

        return response()->json(['message' => 'Matchmaking realizado correctamente'], 200);
    }

    private static function calculateMatchScore($developer, $vacancy): ?JobMatch {
        // Implementa la lógica para calcular la coincidencia
        $score = 0;
        $notes = '';

        if(!self::checkRequiredAcademicLevel($developer, $vacancy))
            return null;

        if($developer->contract_type == $vacancy->contract_type) {
            $score += 10;
            $notes = $developer->contract_type;
        }
        if($developer->schedule == $vacancy->schedule) {
            $score += 10;
            $notes = $developer->schedule;
        }
        if($developer->work_mode == $vacancy->work_mode) {
            $score += 20;
            $notes = $developer->work_mode;
        }

        $matchedSkills = self::matchSkills($developer, $vacancy);
        $score += $matchedSkills * 60;

        if($matchedSkills == 1)
            $notes = 'Dominas los requisitos';

        if($score == 100)
            $notes = '¡Perfecto!';

        $jobMatch = new JobMatch([
            'developer_id' => $developer->id,
            'vacancy_id' => $vacancy->id,
            'score' => $score,
            'notes' => $notes,
        ]);

        return $jobMatch;
    }

    private static function matchSkills($developer, $vacancy): float
    {
        $developerProjectsTechnologies = $developer->projects()->with('technologies')->get()
            ->pluck('technologies.*.name')->flatten()->unique();
        $developerExperiencesTechnologies = $developer->experiences()->with('technologies')->get()
            ->pluck('technologies.*.name')->flatten()->unique();
        $developerSkills = $developerProjectsTechnologies->merge($developerExperiencesTechnologies)->unique()->toArray();

        $requiredSkills = $vacancy->technologies()->pluck('name')->unique()->toArray();

        $commonSkills = array_intersect($developerSkills, $requiredSkills);

        return (count($commonSkills) / count($requiredSkills));
    }

    private static function checkRequiredAcademicLevel($developer, $vacancy):bool
    {
        foreach ($developer->education()->get() as $education) {

            if($vacancy->academic_level == $education->academic_level)
                return true;

            if($vacancy->academic_level == AcademicLevelEnum::Primaria)
                return true;

            if($vacancy->academic_level == AcademicLevelEnum::Secundaria) {
                if ($education->academic_level == AcademicLevelEnum::Bachillerato ||
                    $education->academic_level == AcademicLevelEnum::FP1 ||
                    $education->academic_level == AcademicLevelEnum::FP2 ||
                    $education->academic_level == AcademicLevelEnum::Grado ||
                    $education->academic_level == AcademicLevelEnum::Master ||
                    $education->academic_level == AcademicLevelEnum::Doctorado
                )
                    return true;
            }

            if($vacancy->academic_level == AcademicLevelEnum::Bachillerato) {
                if ($education->academic_level == AcademicLevelEnum::FP1 ||
                    $education->academic_level == AcademicLevelEnum::FP2 ||
                    $education->academic_level == AcademicLevelEnum::Grado ||
                    $education->academic_level == AcademicLevelEnum::Master ||
                    $education->academic_level == AcademicLevelEnum::Doctorado
                )
                    return true;
            }

            if($vacancy->academic_level == AcademicLevelEnum::FP1) {
                if ($education->academic_level == AcademicLevelEnum::FP2)
                    return true;
            }

            if($vacancy->academic_level == AcademicLevelEnum::Grado) {
                if ($education->academic_level == AcademicLevelEnum::Master ||
                    $education->academic_level == AcademicLevelEnum::Doctorado
                )
                    return true;
            }

            if($vacancy->academic_level == AcademicLevelEnum::Master) {
                if ($education->academic_level == AcademicLevelEnum::Doctorado)
                    return true;
            }

        }
        return false;
    }
}
