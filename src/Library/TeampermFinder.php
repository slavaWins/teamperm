<?php


namespace Teamperm\Library;


use App\Contracts\Teamperm\TeamRoleStruct;
use Teamperm\Models\Team;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class TeampermFinder
{

    public static function GetRoles()
    {
         return config('teamperm.roles');
    }

    public static function GetRolesOptions($isRemoveOwner = false)
    {
        $list = collect(self::GetRoles());

        $res = [];
        foreach ($list as $K => $V) {
            $res[$K] = $V->name;
        }
        if ($isRemoveOwner) unset($res['owner']);
        return $res;
    }

    public static function GetMemberRole(Team $team, User $user)
    {
        $role = DB::table('teams_users')->where("user_id", $user->id)->where("team_id", $team->id)->first();
        if (!$role) return null;
        return $role->memberType;
    }
    public static function SetMemberRole(Team $team, User $user, $memberType)
    {
        $role = DB::table('teams_users')->where("user_id", $user->id)->where("team_id", $team->id);

        if(!$memberType){
            $role->delete();
        }else{
            $role->update(["memberType"=> $memberType]);
        }

    }

    /**
     * @param Team $team
     * @param User $user
     * @return TeamRoleStruct|null
     */
    public static function GetRoleData(Team $team, User $user)
    {
        $ind = self::GetMemberRole($team, $user);
        if (!$ind) return null;
        $data = TeampermFinder::GetRoles();
        if (!isset($data[$ind])) return null;

        return $data[$ind];
    }

}
