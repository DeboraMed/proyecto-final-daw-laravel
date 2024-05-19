<?php

namespace App\Enums;

enum AcademicLevelEnum: string
{
    case Primaria = 'Educación Primaria';
    case Secundaria = 'Educación Secundaria Obligatoria (ESO)';
    case Bachillerato = 'Bachillerato';
    case FP1 = 'Ciclo Formativo de Grado Medio';
    case FP2 = 'Ciclo Formativo de Grado Superior';
    case Grado = 'Grado Universitario';
    case Master = 'Máster Universitario';
    case Doctorado = 'Doctorado';
    case Certificacion = 'Certificación';
}
