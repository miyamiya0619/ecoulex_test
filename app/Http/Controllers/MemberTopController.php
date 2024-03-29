<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Support\Facades\Session;



class MemberTopController extends Controller
{

    // お問い合わせトップ画面を表示
    public function index()
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $companyLoginT = Session::get('companyLoginT');


        if ($user) {
            return view('kanri.member.member_dashboard', compact('user','companyLoginT'));
        }

        return view('kanri.registration.loginCompany');
    }

}
