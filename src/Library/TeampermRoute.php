<?php


namespace Teamperm\Library;


use Illuminate\Support\Facades\Route;
use Teamperm\Http\Controllers\PageTeampermController;

class TeampermRoute
{

    public static function routes()
    {

        Route::post('/team/member/add/{team}', [PageTeampermController::class, 'MemberAdd'])->name('team.member.add');

        Route::post('/team/member/delete/{team}', [PageTeampermController::class, 'MemberRemove'])->name('team.member.remove');
        Route::post('/team/member/set/{team}', [PageTeampermController::class, 'MemberSetRole'])->name('team.member.set');
        Route::get('/team/inviteuse/{inviteId}', [PageTeampermController::class, 'InviteShow'])->name('team.member.inviteuse');

        Route::get('/team/inviteuse/{inviteId}/approve', [PageTeampermController::class, 'InviteActivate'])->name('team.member.inviteuse.ok');
        Route::get('/team/inviteuse/{inviteId}/delete', [PageTeampermController::class, 'InviteDelete'])->name('team.member.inviteuse.delete');

    }

}
