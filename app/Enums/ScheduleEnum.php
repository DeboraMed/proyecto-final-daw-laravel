<?php

namespace App\Enums;

enum ScheduleEnum: string
{
    case Completa = 'Completa';
    case MediaJornada = 'Media Jornada';
    case IntensivaManyana = 'Intensiva Mañana';
    case TurnoRotativo = 'Turno Rotativo';
    case PorHoras = 'Por Horas';
}
