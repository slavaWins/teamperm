<?php

namespace App\Library\Teamperm;


use App\Contracts\Tarifiner\TarifVariant;
use App\Models\User;

class TeampermPort
{


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
