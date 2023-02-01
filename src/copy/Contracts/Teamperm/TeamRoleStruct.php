<?php

namespace App\Contracts\Teamperm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Teamperm\Contracts\TeamRoleBaseStruct;

class TeamRoleStruct extends TeamRoleBaseStruct
{



    public bool $canCustomMake1 = false;
    public bool $canCustomMake2 = false;

}
