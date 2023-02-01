<?php

use App\Contracts\Teamperm\TeamRoleStruct;
use App\Providers\RouteServiceProvider;
use Laravel\Fortify\Features;

return [
    'roles' => [
        'owner' => new TeamRoleStruct([
            'name' => "Создатель",
            'canSetOwner' => true,
            'canSetRoleMembers' => true,
            'canDeeleteMembers' => true,
            'canSendInvitations' => true,
            'edit' => true,
            'view' => true,
            'canCustomMake1' => true,
            'canCustomMake2' => true,
        ]),
        'moder' => new TeamRoleStruct([
            'name' => "Модератор",
            'canSetRoleMembers' => true,
            'canDeeleteMembers' => true,
            'canSendInvitations' => true,
            'edit' => true,
            'view' => true,
            'canCustomMake1' => true,
            'canCustomMake2' => true,
        ]),
        'editor' => new TeamRoleStruct([
            'name' => "Редактор",
            'edit' => true,
            'view' => true,
            'canCustomMake1' => true,
            'canCustomMake2' => false,
        ]),
        'viewer' => new TeamRoleStruct([
            'name' => "Наблюдатель",
            'view' => true,
            'canCustomMake1' => false,
            'canCustomMake2' => false,
        ]),
    ],
];
