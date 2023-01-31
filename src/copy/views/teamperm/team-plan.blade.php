@php
    use SlavaWins\Formbuilder\Library\FElement;
    use \Teamperm\Library\TeampermFinder;
    /** @var Teamperm\Models\Team $item  */
    /** @var \App\Models\User $member  */
@endphp


@php
    $members = $item->users->count();
    $maxMembers = 5;
    $percent =round($members/$maxMembers*100);
@endphp

<h4 style="font-size: 17px;">Командный тариф</h4>
<p>Тарифный план привязан к владельцу команды</p>
<BR>
<h4 style="font-size: 17px;" class="opacity-70">Участники {{$members}}/{{$maxMembers}} </h4>
<div class="progress">
    <div class="progress-bar" role="progressbar" style="width: {{$percent}}%" aria-valuenow="{{$percent}}"
         aria-valuemin="0"
         aria-valuemax="100"></div>
</div>

<BR>
<small>

    Узнать стоимость тарифного плана можно самостоятельно в разделе <a href="{{route("tarifiner")}}">Тарифы</a>
    <BR> <BR> Чтобы изменить тарифный план: Перейдите во вкладку Тарифные планы в панели управления сайтом.
</small>
