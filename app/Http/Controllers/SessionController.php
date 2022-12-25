<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createSession(Request $request) : string
    {
        $request->session()->put('UserId','Fahmi');
        $request->session()->put('IsMember',true);

        return "OK";
    }

    public function getSession(Request $request): string
    {
        $UserId = $request->session()->get('UserId','guest');
        $IsMember= $request->session()->get('IsMember',false);

        return "User ID : ${$UserId}, Is Member ${IsMember}";
    }
}
