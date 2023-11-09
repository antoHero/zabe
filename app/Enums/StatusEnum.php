<?php

namespace App\Enums;

enum StatusEnum: string
{
    case OPEN = 'Open';
    case CLOSED = 'Closed';
    case CONSIDERING = 'Considering';
    case IMPLEMENTED = 'Implemented';
    case INPROGRESS = 'In Progress';
}