<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Services\MemberCompanyInfoService;


class AdminCompanyInfoController extends Controller
{

    private $MemberCompanyInfoService;

    public function __construct(MemberCompanyInfoService $MemberCompanyInfoService)
    {

    $this->MemberCompanyInfoService = $MemberCompanyInfoService;

    }
    // お問い合わせトップ画面を表示
    public function index()
    {
        //ログイン後の取得したセッション情報を取り出す
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        // 会社情報を取得する
        $companies = $this->MemberCompanyInfoService->fetchCompanyDetailData($company_id);

        // sessionにデータが入っている場合、画面描画の処理を行う
        if ($user) {            
            return view('kanri.admin.admin_company_info_data', compact('user','companies'));
        }
        // sessionにデータが入っていない（有効期限切れ）場合、ログイン画面に遷移する
        return view('kanri.registration.loginCompany');
    }

}
