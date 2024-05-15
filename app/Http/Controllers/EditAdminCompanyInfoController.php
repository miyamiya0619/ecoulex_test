<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\AdminCompanyInfoService;
use App\Models\Company;

class EditAdminCompanyInfoController extends Controller
{

    private $AdminCompanyInfoService;
    public function __construct(AdminCompanyInfoService $AdminCompanyInfoService)
    {

    $this->AdminCompanyInfoService = $AdminCompanyInfoService;

    }

    // 会員企業管理画面の表示
    public function index()
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        if ($user) {
            
            return view('kanri.admin.updateEditAdminCompanyInfo', compact('user','companies'));
        }

        return view('kanri.registration.loginCompany');
    }

    // 会員企業管理編集画面の表示
    public function showCreateAdminCompany()
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        //登録対象企業IDを取得
        $createCompany_id = $this->AdminCompanyInfoService->fetchCompanyId();

        if ($user) {
            return view('kanri.admin.create_admin_company_info', compact('user','createCompany_id'));
        }

        return view('kanri.registration.loginCompany');
    }

    //新規企業登録処理
    public function createEditAdminCompanyInfo(Request $request)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        $createEditAdminCompanyAll = $request->all();

        if ($user) {
            //新規企業IDの取得
            $createCompany_id = $createEditAdminCompanyAll['createCompany_id'];
            //受け取ったパラメータで企業詳細情報を登録する
            $company_name = $createEditAdminCompanyAll['company_name'];
            $company_name_kana = $createEditAdminCompanyAll['company_name_kana'];
            $email = $createEditAdminCompanyAll['email'];
            $email2 = $createEditAdminCompanyAll['email'];
            $email3 = $createEditAdminCompanyAll['email'];

            //必須項目が入力されている場合、実行
            if(!empty($company_name)&&!empty($company_name_kana)&&!empty($email)){
                
                //メールアドレス存在チェック
                $company = Company::where('email', $email)->first();
                if($company){
                    $request->session()->put('createEditAdminCompanyAll', $createEditAdminCompanyAll);
                    $status = 'このメールアドレス1は既に登録されています。';
                    return view('kanri.admin.create_admin_company_info', compact('user','createCompany_id','status'));
                }


                //新規登録処理
                $this->AdminCompanyInfoService->createCompanyInfo($createEditAdminCompanyAll);

                if(!empty($email)){
                    
                }

                $request->session()->put('createEditAdminCompanyAll', $createEditAdminCompanyAll);
                $status = '登録が完了しました';
                return view('kanri.admin.create_admin_company_info', compact('user','createCompany_id','status'));

            }else{

                $request->session()->put('createEditAdminCompanyAll', $createEditAdminCompanyAll);
                $status = '必須項目をすべて入力してください';
                return view('kanri.admin.create_admin_company_info', compact('user','createCompany_id','status'));
            }
        }

        return view('kanri.registration.loginCompany');
    }

    // 会員企業管理編集画面の表示
    public function showEditAdminCompany($id)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        // 会社情報を取得する
        $companies = $this->AdminCompanyInfoService->fetchCompanyInfoData($id);

        if ($user) {
            
            return view('kanri.admin.edit_admin_company_info', compact('user','companies'));
        }

        return view('kanri.registration.loginCompany');
    }

    // 会員企業管理画面の更新
    public function updateEditAdminCompanyInfo(Request $request)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $updateEditAdminCompanyInfo = $request->all();
        // 会社情報を更新する
        $this->AdminCompanyInfoService->updateCompanyDetailData($updateEditAdminCompanyInfo);

        // 会社情報を取得する
        $companies = $this->AdminCompanyInfoService->fetchCompanyInfoData($updateEditAdminCompanyInfo['company_id']);
        $status = "更新が完了しました";


        if ($user) {
            return view('kanri.admin.edit_admin_company_info', compact('user', 'companies','status'));
        }

        return view('kanri.registration.loginCompany');
    }

    // 会員企業管理削除画面の表示
    public function showdelEditAdminCompany($id)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        // 会社情報を取得する
        $companies = $this->AdminCompanyInfoService->fetchCompanyInfoData($id);

        if ($user) {
            
            return view('kanri.admin.del_admin_company_info', compact('user','companies'));
        }

        return view('kanri.registration.loginCompany');
    }
    
    // 会員企業の削除
    public function deleteEditAdminCompanyInfo(Request $request)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $delEditAdminCompanyInfo = $request->all();
        // 会社情報を削除する
        $this->AdminCompanyInfoService->deleteCompanyDetailData($delEditAdminCompanyInfo);

        $status = "削除が完了しました";
        
        // 会社情報を取得する
        $companies = $this->AdminCompanyInfoService->fetchCompanyDetailData();
        if ($user) {
            return view('kanri.admin.admin_company_info_data', compact('user','status','companies'));
        }

        return view('kanri.registration.loginCompany');
    }


}
