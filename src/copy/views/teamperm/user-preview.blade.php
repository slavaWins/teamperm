@php
    /*** @var $user \App\Models\User */
$ava = '/img/prof.png';
@endphp


<div class="rounded-9"
     style="width: 25px; height: 25px; background: url('{{$ava}}') center; background-size: cover; margin-right: 10px; float: left;"></div>

<span class="opacity-90">  {{'@'.($user->login ?? "notag")}} </span>
<b>
{{$user->name ?? "Без имени"}}
</b>
