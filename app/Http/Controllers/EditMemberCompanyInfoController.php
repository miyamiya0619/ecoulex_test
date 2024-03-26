<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Support\Facades\Session;
use App\Services\MemberCompanyInfoService;


class EditMemberCompanyInfoController extends Controller
{

    private $MemberCompanyInfoService;

    public function __construct(MemberCompanyInfoService $MemberCompanyInfoService)
    {

    $this->MemberCompanyInfoService = $MemberCompanyInfoService;

    }

    // お問い合わせトップ画面を表示
    public function index()
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');
        // 会社情報を取得する
        $companies = $this->MemberCompanyInfoService->fetchCompanyDetailData($company_id);
        //全都道府県を取得する
        $prefectures = $this->MemberCompanyInfoService->fetchPrefecturesCatsData();

        if ($user) {
            
            return view('kanri.member.edit_member_company_info', compact('user','companies','prefectures'));
        }

        return view('kanri.registration.loginCompmany');
    }

    public function updateCompanyInfo(Request $request)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');
        
        if ($user) {
        //パラメータの受け取り、不要な情報を削除
        $companiesdetailsAll = $request->all();

        //受け取ったパラメータで企業詳細情報を更新する
        $this->MemberCompanyInfoService->updateCompanyDetailData($company_id,$companiesdetailsAll);
        
        return redirect()->route('ecoulex.kanri.editMemberCompanyInfo');
        
        }

        return view('kanri.registration.loginCompmany');

    }
    
}
