<?php


namespace Teamperm\Library;


use Teamperm\Models\Team;
use Illuminate\Support\Facades\Route;


trait UuidTeampermTrait
{


    // Helps the application specify the field type in the database
    public function getKeyType ()
    {    dd("Cr");
        return 'string';
    }

}
