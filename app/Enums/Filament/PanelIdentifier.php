<?php

namespace App\Enums\Filament;

enum PanelIdentifier: string
{
    case CRM = 'crm';

    public function path(): string
    {
        return match ($this) {
            self::CRM => 'crm',
        };
    }
}
