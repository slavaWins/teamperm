@php
    /*** @var $team Teamperm\Models\Team */
$ava = '/img/prof.png';
@endphp


<div class="rounded-9"
     style="width: 25px; height: 25px; background: url('{{$ava}}') center; background-size: cover; margin-right: 10px; float: left;"></div>


{{$team->name ?? "Без имени"}}
