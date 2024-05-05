<?php

namespace App\Enums;

enum ContractTypeEnum: string
{
    case Indefinido = 'indefinido';
    case Temporal = 'temporal';
    case Practicas = 'practicas';
    case Autonomo = 'autonomo';
    case ObraYServicio = 'obra y servicio';
}
