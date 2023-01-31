<?php

namespace Teamperm\Models;

use App\Library\MrpProfile\MrpProfileLibary;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MrProperter\Library\PropertyConfigStructure;
use MrProperter\Models\MPModel;

/**
 * @property int id
 * @property int amount
 * @property string ind
 * @property string date_day
 *
 **/
class Teamperm extends  MPModel
{
    use HasFactory;

    public $timestamps = false;

    public function PropertiesSetting()
    {
        $config = new PropertyConfigStructure($this);



        $config->String("name")->SetLabel("Название команды")->SetMin(3)->SetMax(17)->AddTag(['profile']);


        $config->Int("owner_id")->SetLabel("Владелец")->AddTag(['profile'])->SetBelong(User::class, 'user', 'name');

        $config->Select("companyType")->SetLabel("Компания")->SetDescr("Для чего будет использоваться проект.")->SetOptions([
            'not' => "Не указано",
            'personal' => "Для себя",
            'company' => "Бизнес компания",
            'companyBig' => "Организация",
        ])
            ->SetDefault("not")->AddTag(["profile", 'admin']);


        $config->String("profile_bio")->SetLabel("Обо мне")->SetMin(0)->SetMax(412)->SetDefault("")->AddTag(['profile_performer']);

        $config->Int("balance")->SetLabel("Баланс")->SetMin(0)->SetDefault(0)->SetPostfix(" RUB.")->AddTag(['admin']);

        MrpProfileLibary::ExtendUser($config);
        MrpProfileLibary::ExtendUserProjectNotify($config);

        return $config;
    }
}
