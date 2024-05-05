<?php

namespace App\Models;

use App\Enums\ContractTypeEnum;
use App\Enums\ScheduleEnum;
use App\Enums\SpecializationEnum;
use App\Enums\WorkModeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = [
        'github_url',
        'contract_type',
        'work_mode',
        'schedule',
        'specialization',
    ];

    protected $casts = [
        'contract_type' => ContractTypeEnum::class,
        'work_mode' => WorkModeEnum::class,
        'schedule' => ScheduleEnum::class,
        'specialization' => SpecializationEnum::class,
    ];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }
}
