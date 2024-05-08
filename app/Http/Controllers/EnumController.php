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
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;
use function Laravel\Prompts\password;

//use Illuminate\Validation\Rules;

class EnumController extends Controller
{
    public static function toArray($enum): array
    {
        $array = [];
        foreach ($enum::cases() as $case) {
            $array[$case->name] = $case->value;
        }
        return $array;
    }

    public function contractType()
    {
        return response()->json(self::toArray(ContractTypeEnum::class));
    }

    public function schedule()
    {
        return response()->json(self::toArray(ScheduleEnum::class));
    }

    public function specialization()
    {
        return response()->json(self::toArray(SpecializationEnum::class));
    }

    public function workMode()
    {
        return response()->json(self::toArray(WorkModeEnum::class));
    }

    public function academicLevel()
    {
        return response()->json(self::toArray(AcademicLevelEnum::class));
    }

    public function experienceLevel()
    {
        return response()->json(self::toArray(ExperienceLevelEnum::class));
    }

    public function technologyType()
    {
        return response()->json(self::toArray(TechnologyTypeEnum::class));
    }

}
