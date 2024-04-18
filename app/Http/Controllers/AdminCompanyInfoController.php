<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\AdminCompanyInfoService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Str;
use App\Models\Company;
use App\Mail\sendMail;


class AdminCompanyInfoController extends Controller
{

    private $AdminCompanyInfoService;

    public function __construct(AdminCompanyInfoService $AdminCompanyInfoService)
    {

    $this->AdminCompanyInfoService = $AdminCompanyInfoService;

    }
    // お問い合わせトップ画面を表示
    public function index()
    {
        //ログイン後の取得したセッション情報を取り出す
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        // 会社情報を取得する
        $companies = $this->AdminCompanyInfoService->fetchCompanyDetailData();

        // sessionにデータが入っている場合、画面描画の処理を行う
        if ($user) {            
            return view('kanri.admin.admin_company_info_data', compact('user','companies'));
        }
        // sessionにデータが入っていない（有効期限切れ）場合、ログイン画面に遷移する
        return view('kanri.registration.loginCompany');
    }

    public function sendCompanyPassword(Request $request){

        $selectedItems = $request->input('selected_items');
        // ユーザーのパスワードを更新
        foreach($selectedItems as $selectedItem){
            $company = Company::where('company_id', $selectedItem)->first();

            if ($company) {
                $newPassword = Str::random(10); // 10文字のランダムな文字列を生成する例
                $company->password = Hash::make($newPassword);
                $company->save();
        
                // メール送信
                    Mail::to($company)->send(new sendMail($newPassword));
            }
        }

        if(!empty($selectedItems)){
            return redirect()->route('ecoulex.kanri.adminCompanyInfo')->with('status', 'パスワード更新が完了しました');
        }else{
            return redirect()->route('ecoulex.kanri.adminCompanyInfo')->with('status', 'パスワード通知対象の企業を最低1件以上選択してください');
        }



    }

}
