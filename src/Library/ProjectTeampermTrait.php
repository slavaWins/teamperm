<?php


namespace Teamperm\Library;


use Teamperm\Models\Team;
use Teamperm\Models\TeamsUsers;
use App\Models\User;
use Illuminate\Support\Facades\Route;


trait ProjectTeampermTrait
{
    public function CheckTeamPermission(User $user, string $permisionKey)
    {
        if(!$this->team_id) {
            return  $this->user_id == $user->id;
        }

        $team = $this->team;

        $role = TeampermFinder::GetRoleData($team, $user);
        if (!$role) return false;
        if (!isset($role->$permisionKey)) return false;
        return $role->$permisionKey;
    }

    public function team()
    {
        return $this->belongsTo(Team::class, "team_id");
    }


}
