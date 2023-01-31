@php


    use \Teamperm\Library\TeampermFinder;
    /** @var \App\Models\ProjectUser $invite  */
    /** @var Teamperm\Models\Team $team  */
    /** @var \App\Models\User $member  */

@endphp

@extends('layouts.center-mini')

@section('content')

    <h3 class=" " style="font-size: 20px;">
        Вы получили приглашение в команду <b>{{$team->name}}</b> на роль:
    </h3>
    - {{TeampermFinder::GetRolesOptions()[$invite->memberType] }}
    <BR>

    <BR>
    Участники команды:

    @foreach($team->users as $u)
        @if($u->id<>Auth::user()->id)
            <div class="col p-2" style="text-align: left">
                @include('teamperm.user-preview',['user'=>$u])
            </div>
        @endif
    @endforeach

    <BR>
    <BR>


    <a class="btn w-100 btn-outline-primary mb-3" href="{{route('team.member.inviteuse.ok',$invite->id)}}">Принять
        приглашение</a>
    <p class="text-center">или</p>
    <a class="btn w-100  text-danger btn-link" href="{{route('team.member.inviteuse.delete',$invite->id)}}">Отказаться</a>

@endsection

