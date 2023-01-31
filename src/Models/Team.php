<?php


namespace Teamperm\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MrProperter\Library\PropertyConfigStructure;
use MrProperter\Models\MPModel;


/**
 * @property int $id
 * @property string|null $name Название команды
 * @property integer|null $owner_id Владелец
 * @property string $projectType Тип проекта
 */
class Team extends MPModel
{
    use HasFactory;

    const MEMBER_TYPE = [
        'owner' => "Владелец",
        'moder' => "Модераторе",
        'view' => "Зритель",
    ];

    public function PropertiesSetting()
    {
        $config = new PropertyConfigStructure($this);


        $config->String("name")->SetLabel("Название команды")->SetMin(3)->SetMax(17)->AddTag(['profile', 'admin']);

       // $config->Int("owner_id")->SetLabel("Владелец")->AddTag(['profile', 'admin'])->SetBelong(User::class, 'owner', 'name');


        $config->Select("projectType")->SetLabel("Тип проекта")->SetDescr("Для чего будет использоваться проект.")->SetOptions([
            'company' => "Лендинг компании",
            'shop' => "Магазин",
            'portfolio' => "Страница портфолио",
        ])->SetDefault("portfolio")->AddTag(['admin', 'profile']);


        return $config;
    }


    public function owner()
    {
        foreach ($this->users as $u) {
            if ($u->pivot->memberType == "owner") {
                return $u;
            }
        }
        return null;
    }

    public function users()
    {
        return $this->belongsToMany(User::class, "teams_users", "team_id", "user_id")->using(TeamsUsers::class)->withPivot(["memberType", 'is_invite','id']);
    }
}
