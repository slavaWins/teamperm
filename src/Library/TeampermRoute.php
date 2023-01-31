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

    }

}
