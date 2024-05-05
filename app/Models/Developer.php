<?php

namespace App\Models;

use App\Enums\ContractTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = [
        'especialidad',
        'jornada',
        'modalidad',
        'github_url',
    ];

    protected $casts = [
        'contract_type' => ContractTypeEnum::class,
    ];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }
}
