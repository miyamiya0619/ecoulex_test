<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyLoginController extends Controller
{
    public function showCpmanyLoginForm()
    {
        return view('kanri.registration.loginCopmany');
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->put('user', $user);
            return redirect()->intended(route('ecoulex.kanri.memberDashboard'));
        }

        return redirect()->back()->withInput()->withErrors(['loginError' => 'ログインIDまたはパスワードが正しくありません']);
    }

}
