<?php


namespace Teamperm\Library;


use App\Models\Project;
use Teamperm\Models\Team;
use Teamperm\Models\TeamsUsers;
use App\Models\User;
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

    public function projects()
    {
        $teamsIds = $this->teams->pluck('id')->toArray();

        $list  = Project::whereIn('team_id', $teamsIds)->orWhere('user_id', $this->id)->get();

        return $list;


    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, "teams_users", "user_id", "team_id")->using(TeamsUsers::class)->withPivot(["memberType", 'is_invite', 'id']);
    }


}
