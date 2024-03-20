<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberCompanyInfoService;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Support\Facades\Session;



class MemberCompanyInfoController extends Controller
{
    private $MemberCompanyInfoService;
    
    public function __construct(MemberCompanyInfoService $memberCompanyInfoService)
    {
        $this->MemberCompanyInfoService = $memberCompanyInfoService;
    }
    

    // お問い合わせトップ画面を表示
    public function index()
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');

        // sessionにデータが入っている場合、画面描画の処理を行う
        if ($user) {
            //ログインユーザに紐づく企業詳細情報を取得する
            $company_id = $user -> company_id;

            // 会社情報の取得
            $companies = $this->MemberCompanyInfoService->fetchCompanyDetailData($company_id);
            
            return view('kanri.member.member_company_info_data', compact('user','companies'));

        }
        // sessionにデータが入っていない（有効期限切れ）場合、ログイン画面に遷移する
        return view('kanri.registration.loginCopmany');
    }

}
