<?php

namespace App\Models;

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
        'tipo-contrato',
        'github_url',
    ];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }
}
