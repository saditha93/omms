<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseAuthController extends Controller
{

    public function setUserAcess()
    {
        $user = Auth::user();

        return $user;
    }

}
