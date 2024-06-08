<?php

namespace App\Models;

use App\Enums\AcademicLevelEnum;
use App\Enums\ContractTypeEnum;
use App\Enums\ScheduleEnum;
use App\Enums\SpecializationEnum;
use App\Enums\WorkModeEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class);
    }

    public function getCompletionDateFormattedAttribute() {
        return $this->completion_date ? Carbon::parse($this->completion_date)->format('F Y') : null;
    }

    protected $appends = [
        'completion_date_formatted'
    ];
}
