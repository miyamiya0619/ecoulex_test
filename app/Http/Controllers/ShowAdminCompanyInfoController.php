<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\AdminCompanyInfoService;

class ShowAdminCompanyInfoController extends Controller
{

    private $AdminCompanyInfoService;

    public function __construct(AdminCompanyInfoService $AdminCompanyInfoService)
    {

    $this->AdminCompanyInfoService = $AdminCompanyInfoService;

    }

    public function index()
    {
        //ログイン後の取得したセッション情報を取り出す
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        // 会社情報を取得する
        $companies = $this->AdminCompanyInfoService->fetchCompanyDetailData();

        // sessionにデータが入っている場合、画面描画の処理を行う
        if ($user) {            
            return view('kanri.admin.admin_company_detail_info_data', compact('user','companies'));
        }
        // sessionにデータが入っていない（有効期限切れ）場合、ログイン画面に遷移する
        return view('kanri.registration.loginCompany');
    }

    public function showInformation($id)
    {
        //ログイン後の取得したセッション情報を取り出す
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        // 会社情報を取得する
        $information = $this->AdminCompanyInfoService->fetchInformationData($id);

        // sessionにデータが入っている場合、画面描画の処理を行う
        if ($user) {            
            return view('kanri.admin.show_admin_dashboard', compact('user','information'));
        }
        // sessionにデータが入っていない（有効期限切れ）場合、ログイン画面に遷移する
        return view('kanri.registration.loginCompany');
    }
    
}
