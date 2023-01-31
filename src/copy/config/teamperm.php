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
            'canEdit' => true,
            'canView' => true,
        ]),
        'moder' => new TeamRoleStruct([
            'name' => "Модератор",
            'canSetRoleMembers' => true,
            'canDeeleteMembers' => true,
            'canSendInvitations' => true,
            'canEdit' => true,
            'canView' => true,
        ]),
        'editor' => new TeamRoleStruct([
            'name' => "Редактор",
            'canEdit' => true,
            'canView' => true,
        ]),
        'viewer' => new TeamRoleStruct([
            'name' => "Наблюдатель",
            'canView' => true,
        ]),
    ],
];
