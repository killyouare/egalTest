<?php

namespace App\Helpers;

enum Lockmode: string
{
    case AccessShare = "ACCESS SHARE";
    case RowShare = "ROW SHARE";
    case RowExclusive = "ROW EXCLUSIVE";
    case ShareUpdateExclusive = "SHARE UPDATE EXCLUSIVE";
    case Share = "SHARE";
    case ShareRowExclusive = "SHARE ROW EXCLUSIVE";
    case Exclusive = "EXCLUSIVE";
    case AccessExclusive = "ACCESS EXCLUSIVE";
}
