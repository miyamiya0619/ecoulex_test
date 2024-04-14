<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Support\Facades\Session;



class TopController extends Controller
{

    // お問い合わせトップ画面を表示
    public function index()
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $companyLoginT = Session::get('companyLoginT');
        $user_type = Session::get('user_type');



        if ($user) {
            //ユーザタイプが1すなわち会員企業の場合
            if($user_type == 1){
                return view('kanri.member.member_dashboard', compact('user','companyLoginT'));
            }
            //ユーザタイプが2すなわち事務局側の場合
            if($user_type == 2){
                return view('kanri.admin.admin_dashboard', compact('user','companyLoginT'));
            }
        }

        return view('kanri.registration.loginCompany');
    }

}
