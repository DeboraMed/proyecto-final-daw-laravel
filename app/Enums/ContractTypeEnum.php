<?php

namespace App\Enums;

enum ContractTypeEnum: string
{
    case Indefinido = 'Indefinido';
    case Temporal = 'Temporal';
    case Practicas = 'Practicas';
    case Autonomo = 'Autonomo';
    case ObraYServicio = 'Obra y Servicio';
}
