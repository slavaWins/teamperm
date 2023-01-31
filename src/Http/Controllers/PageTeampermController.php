<?php

namespace Teamperm\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\ResponseApi;
use App\Models\Team;
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

    public function MemberAdd(Team $team, Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $uid = $request['uid'];
        $memberType = $request['memberType'];

        $userTo = User::findOrFail($uid);

        if (!$user->CheckTeamPermission($team, 'canSendInvitations')) return ResponseApi::Error("Нет прав на приглашение участников");

        if (TeampermFinder::GetMemberRole($team, $userTo)) {
            return ResponseApi::Error("Пользователь уже имеет приглашение");
        }

        $team->users()->attach($userTo, ['memberType' => $memberType, 'is_invite' => true]);


        return ResponseApi::Successful("FSAFASF AS");

    }
}
