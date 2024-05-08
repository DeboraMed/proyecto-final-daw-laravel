<?php

namespace App\Models;

use App\Enums\ContractTypeEnum;
use App\Enums\ScheduleEnum;
use App\Enums\SpecializationEnum;
use App\Enums\WorkModeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'contract_type',
        'work_mode',
        'schedule',
    ];

    protected $casts = [
        'contract_type' => ContractTypeEnum::class,
        'work_mode' => WorkModeEnum::class,
        'schedule' => ScheduleEnum::class,
    ];
}
