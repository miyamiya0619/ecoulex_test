<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Services\AdminCompanyInfoService;
use Illuminate\Support\Facades\Session;



class TopController extends Controller
{
    private $AdminCompanyInfoService;

    public function __construct(AdminCompanyInfoService $AdminCompanyInfoService)
    {

    $this->AdminCompanyInfoService = $AdminCompanyInfoService;

    }
    // お問い合わせトップ画面を表示
    public function index()
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $companyLoginT = Session::get('companyLoginT');
        $user_type = Session::get('user_type');

        // インフォメーション用会社情報を取得する
        $information = $this->AdminCompanyInfoService->fetchInformationData(null);


        if ($user) {
            //ユーザタイプが1すなわち会員企業の場合
            if($user_type == 1){
                return view('kanri.member.member_dashboard', compact('user','companyLoginT'));
            }
            //ユーザタイプが2すなわち事務局側の場合
            if($user_type == 2){
                return view('kanri.admin.admin_dashboard', compact('user','companyLoginT','information'));
            }
        }

        return view('kanri.registration.loginCompany');
    }

    //フリーワード検索処理
    public function dashboardSearch(Request $request)
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
            
            // インフォメーション用会社情報を取得する
            $information = $this->AdminCompanyInfoService->fetchInformationData(null);
            $status = 'フリーワードを入力してください';
            return view('kanri.admin.admin_dashboard', compact('user','companyLoginT','information','status'));

        }

        //検索結果のレコードを取得する
        $information = $this->AdminCompanyInfoService->fetchInformationSearchResult($search_freeword);
        return view('kanri.admin.admin_dashboard', compact('user','companyLoginT','information','search_freeword'));
    }
        return view('kanri.registration.loginCompany');
    }

    

}
