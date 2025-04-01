<?php

namespace App\Enums\Models\Attributes;

enum AttributeDefinitionType: string
{
    case SELECT = 'select';
    case MULTI_SELECT = 'multi_select';
    case NUMBER = 'number';
    case TEXT = 'text';
}
