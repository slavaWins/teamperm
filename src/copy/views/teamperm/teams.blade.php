@php
    use SlavaWins\Formbuilder\Library\FElement;
    use Teamperm\Library\TeampermFinder;
    /** @var \App\Models\User $item  */
@endphp

<table class="table">
    <tr>
        <td>
            Команда
        </td>
        <td>
            Ваша роль
        </td>
        <td>
            Настройки
        </td>
    </tr>

    @foreach($item->teams as $k=>$V)
        <tr>
            <td>
                @include("teamperm.team-preview",['team'=>$V])
            </td>
            <td>
                {{ TeampermFinder::GetRolesOptions()[$V->pivot->memberType] ?? "Ошибка роли ".$V->pivot->memberType}}
            </td>
            <td>
                @if($V->pivot->is_invite)
                    <small>Вы приглашены в команду</small>
                    <BR>
                    <a href="{{route('team.member.inviteuse', $V->pivot->id)}}">
                        Принять приглашение
                    </a>
                @else
                    <a href="{{route('team.setting', $V)}}">
                        Настройки команды
                    </a>
                @endif
            </td>
        </tr>
    @endforeach
</table>

<div class="card-body py-2 border-bottom">

    Команды состоят из участников организации и отражают структуру компании или группы. Они имеют каскадные разрешения
    на доступ и упоминания.
    Как создатель команды, вы являетесь владельцем.
    <BR>
    <BR>
    <a class="  n  " href="{{ route("poll", "TeamCreatePoll") }}"> Создать команду </a>
    <BR>
    <BR>
</div>

<div class="card-body py-3">
    Каждый владелец аккаунта может создать в свое пространство команду и пригласить пользователей для совместного
    тестирования, разработки и администрирования проектов.
    Персональное приглашение — это способ пригласить в командное пространство зарегистрированных пользователей.
    Для этого вам понадобятся почта или логин, с которыми пользователь проходил регистрацию.
</div>
