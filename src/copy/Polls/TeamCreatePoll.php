<?php

namespace App\Polls;


use App\Models\Project;
use Teamperm\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use MrProperter\Library\PropertyConfigStructure;
use MrProperter\Models\MPModel;
use Steppoll\Library\PollBaseStructure;

class TeamCreatePoll extends PollBaseStructure
{

    public int $stepCount = 2;

    public array $titles = [
        0 => 'Название команды',
        1 => 'Для чего вы используйте',
    ];

    public function IsCan(?User $user)
    {
        if(!$user) return "Требуется авторизация";

        $tarifLimits = \App\Library\Teamperm\TeampermPort::GetUserLimits($user);
        if (count($user->teams) >= $tarifLimits['teams']) {
            return "Тариф не позволяет создать ещё одну команду";
        }
        return true;
    }

    public function Complited(?User $user, array $data)
    {
        log::info("Complited!");

        if (!$user) return redirect()->route("home")->withErrors('Нужен вход');

        $user->isNewbie = false;
        $user->save();

        $team = new Team();
        $team->name = $data['name'];
        $team->owner_id = $user->id;
        $team->save();
        $team->users()->attach($user,['memberType'=>'owner']);
        $team->save();

        return redirect(route("team.setting", $team));
    }


    public function GetSteps()
    {

        $config = new PropertyConfigStructure(new MPModel());

        $config->String("name")->SetLabel("Название проекта")->SetMin(2)->SetMax(312)->AddTag(0);

        $opt = (new Project())->GetProperties()['projectType']->options;
        $config->Select("projectType")->SetLabel("Тип проекта")->SetDescr("Для чего будет использоваться проект.")->SetOptions($opt)
            ->SetDefault("not")->AddTag(1);


        return $config;
    }

}
