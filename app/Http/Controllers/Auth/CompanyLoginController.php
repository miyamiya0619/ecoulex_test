<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;
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
        $email = $request->input('email');
        $password = $request->input('password');

        $Users = $request->all();
        // バリデーションルール
        $rules = [
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required',
            ],
        ];
        // カスタムメッセージ
        $messages = [
            'email.required' => 'メールアドレスは必須です',
            'email.email' => 'メールアドレスの形式が正しくありません',
            'password.required' => 'パスワードは必須です',
        ];
        // バリデーション実行
        $validator = validator()->make($Users, $rules, $messages);

        //エラーとする
        if ($validator->fails()) {
            $status = $validator->errors()->first();
            return redirect()->back()->withInput()->withErrors(['loginError' => $status]);
        }
        
        // ユーザーモデルを使用して手動でユーザーを検索および認証
        $user = Company::where('email', $email)->first();
        
        if (!$user) {
            $user = Company::where('email2', $email)->first();
            if ($user && !Hash::check($password, $user->password2)) {
                $user = null; // パスワードが一致しない場合、ユーザーをnullに戻す
            }
        }
        
        if (!$user) {
            $user = Company::where('email3', $email)->first();
            if ($user && !Hash::check($password, $user->password3)) {
                $user = null; // パスワードが一致しない場合、ユーザーをnullに戻す
            }
        }
        
        if ($user && (Hash::check($password, $user->password) || Hash::check($password, $user->password2) || Hash::check($password, $user->password3))) {
            // 認証に成功した場合、ユーザーをログインさせる
            Auth::login($user);
            
            $request->session()->put('user', $user);
            $company_id = $user->company_id;
            $user_type = $user->user_type;
            $request->session()->put('user_type', $user_type);
            
            // ログイン履歴日時のレコードを挿入する
            $this->MemberCompanyloginService->CreateCompanieshistoryData($company_id);
    
            // 過去ログインした回数を取得する
            $loginCnt = $this->MemberCompanyloginService->fetchCompanieshistoryCntData($company_id);
            // 過去ログインした回数が3回以上の場合、最も古いレコードを削除する
            if ($loginCnt >= 3) {
                $this->MemberCompanyloginService->DeleteCompanieshistoryData($company_id, $loginCnt);
            }
    
            $request->session()->put('company_id', $company_id);
    
            // ユーザに紐づくログイン履歴情報を取得する
            $companyLoginT = $this->MemberCompanyloginService->fetchCompanieshistoryLoginTData($company_id);
            $request->session()->put('companyLoginT', $companyLoginT);
    
            // ユーザ種別が2の場合、すなわち事務局側の場合事務局側管理画面に遷移する
            if ($user_type == 2) {
                return redirect()->intended(route('ecoulex.kanri.adminDashboard'));
            } else {
                return redirect()->intended(route('ecoulex.kanri.memberDashboard'));
            }
        }
        
        return redirect()->back()->withInput()->withErrors(['loginError' => 'ログインIDまたはパスワードが正しくありません']);
    }
    
}