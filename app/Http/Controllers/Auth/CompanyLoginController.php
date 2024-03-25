<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Companieshistory;
use App\Services\MemberCompanyloginService;


class CompanyLoginController extends Controller
{

    private $MemberCompanyloginService;
    
    public function __construct(MemberCompanyloginService $MemberCompanyloginService)
    {
        $this->MemberCompanyloginService = $MemberCompanyloginService;
    }
    
    
    public function showCpmanyLoginForm()
    {
        return view('kanri.registration.loginCopmany');
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) 
        {
            $user = Auth::user();
            $request->session()->put('user', $user);

            //認証が成功した場合、ログイン履歴テーブルにレコードを挿入する。
            $company_id = $user -> company_id;
            //ログイン履歴日時のレコードを挿入する
            $this->MemberCompanyloginService->CreateCompanieshistoryData($company_id);

            //過去ログインした回数を取得する
            $loginCnt = $this->MemberCompanyloginService->fetchCompanieshistoryCntData($company_id);
            //過去ログインした回数が3回以上の場合、最も古いレコードを削除する
            if ($loginCnt >= 3) 
            {
                $this->MemberCompanyloginService->DeleteCompanieshistoryData($company_id,$loginCnt);
            }

            $request->session()->put('company_id', $company_id);

            //ユーザに紐づくログイン履歴情報を取得する
            $companyLoginT = $this->MemberCompanyloginService->fetchCompanieshistoryLoginTData($company_id);
            $request->session()->put('companyLoginT', $companyLoginT);

        return redirect()->intended(route('ecoulex.kanri.memberDashboard'));
        }
    return redirect()->back()->withInput()->withErrors(['loginError' => 'ログインIDまたはパスワードが正しくありません']);
    }
}