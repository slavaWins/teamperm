<?php

namespace App\Http\Controllers\MrpProfile;


use App\Http\Controllers\Controller;
use App\Library\MrpProfile\MrpProfileLibary;
use App\Models\Project;
use Teamperm\Models\Team;
use  Teamperm\Models\Teamam;
use MrpProfile\Library\PageBuilder;
use App\Models\ResponseApi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MrProperter\Library\FormBuilderStructure;


class TeamMrpSettingController extends Controller
{


    public function profile(Team $team, Request $request)
    {

        /** @var User $user */
        $user = Auth::user();
        if(!$user->CheckTeamPermission($team, "edit")){
            return abort(404);
        }

        $result = $team->ValidateAndFilibleByRequest($request->toArray(), "profile");
        if ($result === true) {
            return ResponseApi::Successful();
        }
        return ResponseApi::Error($result);
    }


    public function index(Team $team)
    {
        /** @var User $user */
        $user = Auth::user();
        if(!$user->CheckTeamPermission($team, "view")){
            return abort(404);
        }

        $item = $team;

        $page = PageBuilder::New($item);
        $page->name = "Настройки команды ".$item->name;
        $page->icon = "/img/prof.png";


        $page->AddRow("Проекты");
        $page->AddTab("Проекты")->view = "teamperm.projects";


        $page->AddRow("Участники");
        $page->AddTab("Участники")->view = "teamperm.members";

        $page->AddRow("Общие настройки");
        $page->AddTab("Информация о профиле")
            ->SetTag("profile")->SetAjax(true)->SetRoute(route("project.setting.profile", $team));
        $page->AddTab("Интеграции")->SetTitle("У вас нет доступа к интеграциям");




        return view("mrp-profile.index", compact(['item', 'page']));
    }
}
