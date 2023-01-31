<?php

namespace Teamperm\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Library\Teamperm\TeampermPort;
use App\Models\ResponseApi;
use Teamperm\Models\Team;
use Teamperm\Models\TeamsUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Teamperm\Library\TeampermFinder;

class PageTeampermController extends Controller
{


    public function MemberSetRole(Team $team, Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $userTo = User::find($request->input('uid'));
        $toRole = $request->input('role');

        if (!isset(TeampermFinder::GetRoles()[$toRole])) return ResponseApi::Error("Ошибка роли");


        if (!$user->CheckTeamPermission($team, 'canSetRoleMembers')) return ResponseApi::Error("Нет прав на на изменение ролей участников");
        if (!$userTo) return ResponseApi::Error("Нет пользвателя");

        if (TeampermFinder::GetMemberRole($team, $userTo) == "owner") {
            return ResponseApi::Error("Нельзя менять права владельца");
        }

        TeampermFinder::SetMemberRole($team, $userTo, $toRole);

        return ResponseApi::Successful();
    }

    public function MemberRemove(Team $team, Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $userTo = User::find($request->input('uid'));

        if (!$user->CheckTeamPermission($team, 'canDeeleteMembers')) return ResponseApi::Error("Нет прав на удаление участников");
        if (!$userTo) return ResponseApi::Error("Нет пользвателя");

        if (TeampermFinder::GetMemberRole($team, $userTo) == "owner") return ResponseApi::Error("Нельзя удалить владельца");


        TeampermFinder::SetMemberRole($team, $userTo, null);

        return ResponseApi::Successful();
    }

    public function InviteShow($inviteId)
    {

        /** @var User $user */
        $user = Auth::user();


        $invite = TeamsUsers::where("id", $inviteId)
            ->where('user_id', $user->id)
            ->where('is_invite', true)
            ->first();
        if (!$invite) abort(404);


        $team = Team::find($invite->team_id);
        if (!$team) abort(404);


        return view("teamperm.page-invite", compact('team', 'invite'));
    }

    public function InviteDelete($invite)
    {
        /** @var User $user */
        $user = Auth::user();


        $inv = TeamsUsers::where("id", $invite)
            ->where('user_id', $user->id)
            ->where('is_invite', true)
            ->first();
        if (!$inv) abort(404);

        $inv->delete();

        return redirect()->route("home");
    }

    public function InviteActivate($invite)
    {

        /** @var User $user */
        $user = Auth::user();


        $inv = TeamsUsers::where("id", $invite)
            ->where('user_id', $user->id)
            ->where('is_invite', true)
            ->first();
        if (!$inv) abort(404);


        $team = Team::find($inv->team_id);
        if (!$team) abort(404);

        $inv->is_invite = false;
        $inv->save();


        $owner = $team->owner();
        if ($owner) {
            $mess = "";
            $mess .= $user->name . ' принял приглашение в команду ' . $team->name;
            TeampermPort::SendNotification($owner, "Новый участник в команде", $mess);
        }

        return redirect()->route('team.setting', $inv->team_id);
    }

    public function MemberAdd(Team $team, Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $uid = $request['uid'];
        $memberType = $request['memberType'];

        if (!isset(TeampermFinder::GetRoles()[$memberType])) return ResponseApi::Error("Ошибка роли");
        if (empty($uid)) return ResponseApi::Error("Ошибка логина");


        if (!$user->CheckTeamPermission($team, 'canSendInvitations')) return ResponseApi::Error("Нет прав на приглашение участников");

        $tarifLimits = \App\Library\Teamperm\TeampermPort::GetUserLimits($team->owner());
        if (count($team->users) >= $tarifLimits['teamMembers']) {
            return ResponseApi::Error("Тариф владельца команды не позволяет добавить ещё одного участника.");
        }

        $uid = trim($uid, "_");
        $userTo = User::where("login", $uid)->whereOr('email, $uid')->first();
        if (!$userTo) return ResponseApi::Error("Пользователь не найден");


        if (TeampermFinder::GetMemberRole($team, $userTo)) {
            return ResponseApi::Error("Пользователь уже имеет приглашение");
        }

        $xz = $team->users()->attach($userTo, ['memberType' => $memberType, 'is_invite' => true]);

        $invite = TeamsUsers::where("team_id", $team->id)->where("user_id", $userTo->id)->where('is_invite', true)->first();

        if (!$invite) {
            return ResponseApi::Error("Не удалось создать инвайт");
        }

        $invId = $invite->id;

        $mess = "";
        $mess .= "Здравствуйте! \n";
        $mess .= $user->name . ' создал для вас приглашение в комнаду ' . $team->name;
        $mess .= "\n Нажмите кнопку ниже что бы принять приглашение. ";
        $link = route('team.member.inviteuse', $invId);
        TeampermPort::SendNotification($userTo, "Приглашение в команду", $mess, "Перейти", $link);

        return ResponseApi::Successful("FSAFASF AS");

    }
}
