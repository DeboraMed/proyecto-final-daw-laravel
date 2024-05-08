<?php

namespace App\Models;

use App\Enums\AcademicLevelEnum;
use App\Enums\ContractTypeEnum;
use App\Enums\ScheduleEnum;
use App\Enums\SpecializationEnum;
use App\Enums\WorkModeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution',
        'qualification',
        'academic_level',
        'completion_date',
    ];

    protected $casts = [
        'academic_level' => AcademicLevelEnum::class,
    ];
}