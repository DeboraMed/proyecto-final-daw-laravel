<?php

namespace App\Http\Controllers;

use App\Enums\AcademicLevelEnum;
use App\Enums\ContractTypeEnum;
use App\Enums\ExperienceLevelEnum;
use App\Enums\ScheduleEnum;
use App\Enums\SpecializationEnum;
use App\Enums\TechnologyTypeEnum;
use App\Enums\WorkModeEnum;
use App\Models\Company;
use App\Models\Developer;
use App\Models\Technology;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;
use function Laravel\Prompts\password;

//use Illuminate\Validation\Rules;

class TechnologyController extends Controller
{
    public function index()
    {
        return response()->json(['technologies' => Technology::all()], 200);
    }
}
