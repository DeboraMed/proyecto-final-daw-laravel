<?php

namespace App\Enums;

enum AcademicLevelEnum: string
{
    case Sin_estudios = 'Sin estudios';
    case ESO = 'ESO';
    case Bachillerato = 'Bachillerato';
    case FP_Grado_Medio = 'FP Grado Medio';
    case FP2_Grado_Superior = 'FP2 Grado Superior';
    case Diplomado = 'Diplomado';
    case Licenciado = 'Licenciado';
    case Postgrado = 'Postgrado';
    case Certificacion = 'Certificacion';
}
