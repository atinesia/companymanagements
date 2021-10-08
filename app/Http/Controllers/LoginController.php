<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credential = $request->only('email','password');
        if(Auth::attempt($credential)){
            return redirect(route(''));
        }
    }
}
