<?php

namespace App\Models\Enums;

enum Role :string
{
    case ADMINISTRATOR = 'administrator';
    case EMPLOYEE = 'employee';
    case EMPLOYER = 'employer';
}
