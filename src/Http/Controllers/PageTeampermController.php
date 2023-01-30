<?php

namespace Teamperm\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageTeampermController extends Controller
{


    public function index()
    {
        return view('teamperm::page');
    }
}
