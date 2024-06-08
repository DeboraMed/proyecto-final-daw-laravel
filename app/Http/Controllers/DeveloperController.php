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

class DeveloperController extends Controller
{
    public function index(Request $request)
    {
        $query = Developer::query();

        if ($request->has('specialization')) {
            $query->where('specialization', $request->input('specialization'));
        }
        if ($request->has('schedule')) {
            $query->where('schedule', $request->input('schedule'));
        }
        if ($request->has('work_mode')) {
            $query->where('work_mode', $request->input('work_mode'));
        }
        if ($request->has('contract_type')) {
            $query->where('contract_type', $request->input('contract_type'));
        }

        return response()->json(['developers' => $query->with('user')->get()], 200);
    }

    public function random()
    {
        //
        return response()->json(['developers' => Developer::with('user')->take(10)->inRandomOrder()->paginate(10)], 200);
    }

    public function show($id)
    {
        return response()->json(['developer' => Developer::with(['user', 'projects.technologies'])->findOrFail($id)], 200);
    }
}
