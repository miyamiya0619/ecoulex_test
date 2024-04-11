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
        
        return view('kanri.registration.loginCompany');
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) 
        {
            $user = Auth::user();
            $request->session()->put('user', $user);
            
            $company_id = $user -> company_id;
            $user_type = $user -> user_type;
            $request->session()->put('user_type', $user_type);


            //ユーザ種別を取得
            //ユーザ種別が2の場合、すなわち事務局側の場合事務局側管理画面に遷移する
            if($user_type == 2){
                return redirect()->intended(route('ecoulex.kanri.adminDashboard'));
            }

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