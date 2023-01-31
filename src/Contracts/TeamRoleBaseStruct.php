<?php

namespace Teamperm\Contracts;

use App\Contracts\Teamperm\TeamRoleStruct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TeamRoleBaseStruct

{


    public string $name = "Админ";

    /** @var bool может отправлять приглашения */
    public bool $canSendInvitations = false;

    public bool $canDeeleteMembers = false;
    public bool $canSetRoleMembers = false;
    public bool $canSetOwner = false;


    public function __construct($fill = [])
    {
        foreach ($fill as $K=>$V){
            if(isset($this->$K)){
                $this->$K = $V;
            }
        }
    }


}
