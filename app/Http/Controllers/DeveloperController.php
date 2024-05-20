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
    public function index()
    {
        //
        return response()->json(['deverlopers' => Developer::with('user')->get()], 200);
    }
}