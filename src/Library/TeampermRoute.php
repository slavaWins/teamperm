<?php


namespace Teamperm\Library;


use Illuminate\Support\Facades\Route;

class TeampermRoute
{

    public static function routes()
    {
        Route::get('/example/teamperm', [\Teamperm\Http\Controllers\PageTeampermController::class, 'index']);
    }

}
