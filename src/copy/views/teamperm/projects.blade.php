@php
    use SlavaWins\Formbuilder\Library\FElement;
    use Teamperm\Library\TeampermFinder;
    /** @var \App\Models\Team $item  */
@endphp


<div class="card-body py-2 border-bottom  " style="background: #f2f2f2;">

    <h2>Проекты команды</h2>
    <BR>
    <div class="row gap-3 row-cols-3">
        @foreach($item->projects() as $k=>$project)
            @include('project.preview', $project)
        @endforeach
    </div>

    <BR>
    <BR>
    Команды состоят из участников организации и отражают структуру компании или группы. Они имеют каскадные разрешения
    на доступ и упоминания.
    Как создатель команды, вы являетесь владельцем.
    <BR>
    <BR>
    <a class="  n  " href="{{ route("poll", "TeamCreatePoll") }}"> Создать проект </a>
    <BR>
    <BR>
</div>

<div class="card-body py-3">
    Каждый владелец аккаунта может создать в свое пространство команду и пригласить пользователей для совместного
    тестирования, разработки и администрирования проектов.
    Персональное приглашение — это способ пригласить в командное пространство зарегистрированных пользователей.
    Для этого вам понадобятся почта или логин, с которыми пользователь проходил регистрацию.
</div>
