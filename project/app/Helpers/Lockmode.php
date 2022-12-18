<?php

namespace App\Helpers;

enum Lockmode
{
    case AccessShare;
    case RowShare;
    case RowExclusive;
    case ShareUpdateExclusive;
    case Share;
    case ShareRowExclusive;
    case Exclusive;
    case AccessExclusive;
}
