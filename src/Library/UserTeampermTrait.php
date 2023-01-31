<?php


namespace Teamperm\Library;


use App\Models\Team;
use Illuminate\Support\Facades\Route;


trait UserTeampermTrait
{
    public function CheckTeamPermission(Team $team, string $permisionKey)
    {
        $role = TeampermFinder::GetRoleData($team, $this);
        if (!$role) return false;
        if (!isset($role->$permisionKey)) return false;
        return $role->$permisionKey;
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, "teams_users", "user_id", "team_id")->withPivot("memberType");
    }


}
