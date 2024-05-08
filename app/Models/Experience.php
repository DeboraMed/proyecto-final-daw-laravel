<?php

namespace App\Models;

use App\Enums\ContractTypeEnum;
use App\Enums\ExperienceLevelEnum;
use App\Enums\ScheduleEnum;
use App\Enums\SpecializationEnum;
use App\Enums\WorkModeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'description',
        'start_date',
        'end_date',
        'level'
    ];

    protected $casts = [
        'level' => ExperienceLevelEnum::class,
    ];
}
