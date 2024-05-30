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

class CompanyController extends Controller
{
    public function show($id)
    {
        return response()->json(['company' => Company::with(['user', 'vacancies.technologies'])->findOrFail($id)], 200);
    }
}
