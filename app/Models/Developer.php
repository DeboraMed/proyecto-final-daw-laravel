<?php

use App\Models\User;

class Developer extends Model
{
    protected $fillable = [
        'especialidad',
        'jornada',
        'modalidad',
        'tipo-contrato',
    ];

    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }

    private function morphOne(string $string, string $string1)
    {
    }

}
