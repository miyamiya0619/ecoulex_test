<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Support\Facades\Session;



class MemberWaterproofingManagementController extends Controller
{

    // お問い合わせトップ画面を表示
    public function index()
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');


        if ($user) {
            return view('kanri.member.member_waterproofing_management_data', compact('user'));
        }

        return view('kanri.registration.loginCpmany');
    }

}
