<?php

namespace App\Enums;

enum Role : string
{
    case SUPER_ADMIN = 'super-admin';
    case REGULAR = 'regular';
    case SECURITY = 'security';
    case HEALTH_OFFICER = 'health-officer';
    case MEDICAL = 'medical';
}
