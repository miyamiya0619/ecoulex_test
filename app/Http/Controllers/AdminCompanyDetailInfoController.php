<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\AdminCompanyDetailInfoService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Str;
use App\Models\Company;
use App\Mail\sendMail;


class AdminCompanyDetailInfoController extends Controller
{

    private $AdminCompanyDetailInfoService;

    public function __construct(AdminCompanyDetailInfoService $AdminCompanyDetailInfoService)
    {

    $this->AdminCompanyDetailInfoService = $AdminCompanyDetailInfoService;

    }
    // お問い合わせトップ画面を表示
    public function index()
    {
        //ログイン後の取得したセッション情報を取り出す
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        // 会社情報を取得する
        $companies = $this->AdminCompanyDetailInfoService->fetchCompanyDetailDataAll();

        // sessionにデータが入っている場合、画面描画の処理を行う
        if ($user) {            
            return view('kanri.admin.admin_company_detail_info_data', compact('user','companies'));
        }
        // sessionにデータが入っていない（有効期限切れ）場合、ログイン画面に遷移する
        return view('kanri.registration.loginCompany');
    }

    //メールアドレスフリーワード検索処理
    public function companiesDetailSearch(Request $request)
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
            $companies = $this->AdminCompanyDetailInfoService->fetchCompanyDetailDataAll();
            $status = 'フリーワードを入力してください';
            return view('kanri.admin.admin_company_detail_info_data', compact('user','companies','status','search_freeword'));

        }

        //検索結果のレコードを取得する
        $companies = $this->AdminCompanyDetailInfoService->fetchCompanyDetailSearchData($search_freeword);
        return view('kanri.admin.admin_company_detail_info_data', compact('user','companies','search_freeword'));
    }
        return view('kanri.registration.loginCompany');
    }




}
