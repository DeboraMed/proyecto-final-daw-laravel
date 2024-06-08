<?php

namespace App\Models;

use App\Enums\ContractTypeEnum;
use App\Enums\ExperienceLevelEnum;
use App\Enums\ScheduleEnum;
use App\Enums\SpecializationEnum;
use App\Enums\WorkModeEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class);
    }

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class);
    }

    public function getStartDateFormattedAttribute() {
        return $this->start_date ? Carbon::parse($this->start_date)->format('F Y') : null;
    }

    public function getEndDateFormattedAttribute() {
        return $this->end_date ? Carbon::parse($this->end_date)->format('F Y') : null;
    }

    protected $appends = [
        'start_date_formatted',
        'end_date_formatted'
    ];
}
