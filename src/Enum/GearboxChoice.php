<?php

namespace App\Enum;

enum GearboxChoice: string
{
    case Manual = 'Manual';
    case Automatic = 'Automatic';
    
    public function getLabel(): string
    {
        return match ($this) {
            self::Manual => 'Manuelle',
            self::Automatic => 'Automatique',
        };
    }
}