<?php

namespace App\Enums;

enum LotteriesEnum: string
{
    case MEGA_SENA = 'mega-sena';

    public function id(): int
    {
        return match ($this) {
            static::MEGA_SENA => 1
        };
    }

    public function label(): string
    {
        return match ($this) {
            static::MEGA_SENA => 'Mega Sena'
        };
    }
}
