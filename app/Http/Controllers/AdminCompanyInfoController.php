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

        //ログイン後の取得したセッション情報を取り出す
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        $selectedItems = $request->input('selected_items');
        // ユーザーのパスワードを更新
        if(!empty($selectedItems)){
            foreach($selectedItems as $selectedItem){
                $company = Company::where('company_id', $selectedItem)->first();
    
                if ($company) {
                    $newPassword = Str::random(10); // 10文字のランダムな文字列を生成する例
                    $newPassword2 = Str::random(10); // 10文字のランダムな文字列を生成する例
                    $newPassword3 = Str::random(10); // 10文字のランダムな文字列を生成する例

                    $company->password = Hash::make($newPassword);
                    $company->password2 = Hash::make($newPassword2);
                    $company->password3 = Hash::make($newPassword3);
                    
                    $company->updated_at = now();
                    
                    // メール送信
                    Mail::to($company)->send(new sendMail($newPassword));
                    if(!empty($company->email2)){
                        Mail::to($company->email2)->send(new sendMail($newPassword2));
                    }
                    if(!empty($company->email3)){
                        Mail::to($company->email3)->send(new sendMail($newPassword3));
                    }

                    $company->send_flg = 1;
                    $company->save();

                }
            }
        }
        // 会社情報を取得する
        $companies = $this->AdminCompanyInfoService->fetchCompanyDetailData();
    

        if(!empty($selectedItems)){
            $status = "パスワード更新が完了しました";
            return view('kanri.admin.admin_company_info_data', compact('user','companies','status'));
        }else{
            $status = "パスワード通知対象の企業を最低1件以上選択してください";
            return view('kanri.admin.admin_company_info_data', compact('user','companies','status'));
        }
    }

    //企業検索処理
    public function companiesSearch(Request $request)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $companyLoginT = Session::get('companyLoginT');
        $user_type = Session::get('user_type');

        if ($user) {
        //パラメータの受け取る
        $resultData = $request->all();

        $search_freeword = $resultData['search_freeword'];

        //フリーワードに値が入力されていない場合はメッセージを表示する
        if(empty($search_freeword)){

            // 会社情報を取得する
            $companies = $this->AdminCompanyInfoService->fetchCompanyDetailData();
            $status = 'フリーワードを入力してください';
            return view('kanri.admin.admin_company_info_data', compact('user','companies','status','search_freeword'));

        }

        //検索結果のレコードを取得する
        $companies = $this->AdminCompanyInfoService->fetchCompanyDetailSearchData($search_freeword);
        return view('kanri.admin.admin_company_info_data', compact('user','companies','search_freeword'));
    }
        return view('kanri.registration.loginCompany');
    }


    //パスワード未送信企業
    public function notsendSearch(Request $request)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $user_type = Session::get('user_type');

        if ($user) {
        //パラメータの受け取る
        $resultData = $request->all();

        //検索結果のレコードを取得する
        $companies = $this->AdminCompanyInfoService->fetchCompanyDetailNotsendData();
        return view('kanri.admin.admin_company_info_data', compact('user','companies'));
    }
        return view('kanri.registration.loginCompany');
    }



}
