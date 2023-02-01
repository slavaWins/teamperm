<?php

namespace App\Library\Teamperm;


use App\Contracts\Tarifiner\TarifVariant;
use App\Models\User;
use Tarifiner\Library\TarifinerLib;

class TeampermPort
{


    public static function GetUserLimits(User $user)
    {
        $response = [
            'teams' => 1,
            'teamMembers' => 2,
        ];

        /** @var TarifVariant $tarifVariant */
        $tarifVariant = config('tarifiner.variants')[$user->tarifInd ?? ""] ?? null;
        if (!$tarifVariant) return $response;

        $response['teams'] = $tarifVariant->teams;
        $response['teamMembers'] = $tarifVariant->teamMembers;

        return $response;
    }

    public static function SendNotification(User $user, $title, $message, $btnText = null, $link = null)
    {
        $m = $user->SendNotification()
            ->SetTitle($title)
            ->SetMessage($message);

        if ($btnText) {
            $m->SetBtn($btnText, $link);
        }
        $m->SendToUser($user);

        return null;
    }

}
