<?php

    namespace App\Http\Controllers\Teamperm;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class TeampermController extends Controller
    {


        public function index() {


            return view('teamperm.example');

        }
    }
