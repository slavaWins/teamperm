<?php

namespace Teamperm\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Str;
use MrProperter\Library\PropertyConfigStructure;
use MrProperter\Models\MPModel;
use Teamperm\Library\UuidTeampermTrait;


class TeamsUsers extends Pivot
{

    protected $table='teams_users';
    protected $fillable=[
        'memberType',
        'team_id',
        'is_invite',
        'user_id',
        'id',
    ];
    public function save(array $options = [])
    {
        $this->id = (string)Str::uuid();
        return parent::save($options); // TODO: Change the autogenerated stub
    }


}
