@php
    use SlavaWins\Formbuilder\Library\FElement;
    use \Teamperm\Library\TeampermFinder;
    /** @var Teamperm\Models\Team $item  */
    /** @var \App\Models\User $member  */

        /** @var \App\Models\User $user */
        $user = Auth::user();
@endphp


<div class="row   m-0   ">


    <div class="col p-0 pt-3">
        <div class="card-body py-0">


            <h2>Участники</h2>
            <div class="  alert alert-danger w-100 errorShowMembers animate-bounce animate" style="display: none">xzv
            </div>
        </div>

        <table class="table table-column-group ">
            <thead>
            <td>
                Участник
            </td>
            <td>
                Роль
            </td>
            <td>

            </td>
            </thead>

            @foreach($item->users as $k=>$member)
                <tr class="memberItemList" teamId="{{$item->id}}" uid="{{$member->id}}">
                    <td>
                        @include("teamperm.user-preview",['user'=>$member])

                        @if($member->pivot->is_invite)
                            <BR> <small class="opacity-90">Ещё не дал согласие</small>
                        @endif
                    </td>
                    <td>
                        @if($member->pivot->memberType == "owner" or !$user->CheckTeamPermission($item, "canSetRoleMembers"))
                            {{TeampermFinder::GetRolesOptions()[$member->pivot->memberType] ?? "Ошибка"}}
                        @else
                            @php
                                FElement::New()->SetView()->InputSelect()
                                 ->SetName("memberType")
                                 ->AddOptionFromArray(TeampermFinder::GetRolesOptions(true))
                                 ->SetValue($member->pivot->memberType?? "" )
                                 ->RenderHtml(true);
                            @endphp
                        @endif
                    </td>
                    @if($user->CheckTeamPermission($item, "canDeeleteMembers"))
                        <td>
                            <a class="deleteBtn btn cursor-alias btn-link btn-sm">
                                @if($member->pivot->is_invite)
                                    Отменить приглашение
                                @else
                                    Удалить
                                @endif
                            </a>
                        </td>
                    @endif
                </tr>

            @endforeach
        </table>
        @if($user->CheckTeamPermission($item, "canSendInvitations"))
            <div class="card-body pt-0">
                <x-easy-form route="{{route('team.member.add', $item)}}" btn="Добавить">


                    <div class="col py-3">
                        Добавить участника
                    </div>


                    @php
                        FElement::NewInputText()
                         ->SetName("uid")
                         ->SetLabel("Логин или почта")
                         ->SetDescr("Укажите @логин или почту участника что бы отправить приглашение ")
                         ->SetValue(old("message" ) )
                         ->RenderHtml(true);
                    @endphp

                    @php
                        FElement::New()->SetView()->InputSelect()
                         ->SetName("memberType")
                         ->AddOptionFromArray(TeampermFinder::GetRolesOptions(true))
                         ->SetValue(old("convenient_delivery_time") )
                         ->RenderHtml(true);
                    @endphp

                </x-easy-form>

            </div>

        @endif
    </div>


    <div class="col-3 border border-r-0 py-3"
         style="border-right: none !important; border-top: none !important; border-bottom: none !important;">

        @include('teamperm.team-plan')
    </div>
</div>
