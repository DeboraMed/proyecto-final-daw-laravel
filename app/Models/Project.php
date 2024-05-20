<?php

namespace App\Models;

use App\Enums\ContractTypeEnum;
use App\Enums\ScheduleEnum;
use App\Enums\SpecializationEnum;
use App\Enums\WorkModeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'img_url',
    ];

    protected $hidden = [
        'img_url',
    ];

    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class);
    }

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class);
    }

    public function getImageUrlAttribute() {
        return $this->img_url ? asset('storage/' . $this->img_url) : null;
    }

    protected $appends = ['image_url'];
}
