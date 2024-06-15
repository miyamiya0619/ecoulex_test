<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\AdminCompanyDetailInfoService;
use App\Models\Company;

class EditAdminCompanyDetailInfoController extends Controller
{

    private $AdminCompanyDetailInfoService;
    public function __construct(AdminCompanyDetailInfoService $AdminCompanyDetailInfoService)
    {

    $this->AdminCompanyDetailInfoService = $AdminCompanyDetailInfoService;

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


     // 会員企業管理画面の表示
     public function showEditAdminCompanyDetail($id)
     {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        // 企業情報を取得する
        $companies = $this->AdminCompanyDetailInfoService->fetchCompanyDetailData($id);
        $prefectures = $this->AdminCompanyDetailInfoService->fetchPrefecturesCatsData();
 
        if ($user) {
            
            return view('kanri.admin.edit_admin_company_detail_info', compact('user','companies','prefectures'));
        }

        return view('kanri.registration.loginCompany');
     }
    //企業情報更新
     public function updateCompanyDetailInfo(Request $request)
     {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        if ($user) {
        //パラメータの受け取り
        $companiesdetailsAll = $request->all();
        $id = $companiesdetailsAll['company_id'];
        //受け取ったパラメータで企業詳細情報を更新する
        $address_num = $companiesdetailsAll['address_num'];
        $prefectureId = $companiesdetailsAll['prefectureId'];
        $addressDetail = $companiesdetailsAll['addressDetail'];
        $representative = $companiesdetailsAll['representative'];

        // バリデーションルール
        $rules = [
        'url' => [
            'nullable',
            'url'  // URL形式チェック
        ],
        'address_num' => [
            'required',
            'regex:/^\d{3}-?\d{4}$/'
        ],

        'addressDetail' => [
            'required',

        ],

        'number_of_employees' => [
            'nullable',

        ],

        'year_of_establishment' => [
            'nullable',

        ],

        'capital' => [
            'nullable',

        ],

        'representative' => [
            'required',

        ],

        'phone' => [
            'nullable',
            'regex:/^0\d{1,4}-\d{1,4}-\d{4}$/' // 電話番号の形式チェック
        ],

        'form' => [
            'nullable',
            'url'  // URL形式チェック
        ],
        
    ];

    // カスタムメッセージ
    $messages = [
        'url.url' => 'WEBサイトの形式が正しくありません',
        'address_num.required' => '郵便番号は必須です',
        'address_num.regex' => '郵便番号の形式が正しくありません',
        'addressDetail.required' => '所在地は必須です',
        'representative.required' => '代表者は必須です',
        'phone.regex' => '電話番号の形式が正しくありません',
        'form.url' => 'フォームの形式が正しくありません',
    ];

    // バリデーション実行
    $validator = validator()->make($companiesdetailsAll, $rules, $messages);

    if ($validator->fails()) {
        $errors = $validator->errors()->toArray();
        $companies = $this->AdminCompanyDetailInfoService->fetchCompanyDetailData($id);
        $prefectures = $this->AdminCompanyDetailInfoService->fetchPrefecturesCatsData();
        return view('kanri.admin.edit_admin_company_detail_info', compact('user','errors','companies','prefectures'));
    }

        //必須項目が入力されている場合、実行
    $status = '更新が完了しました';
    $this->AdminCompanyDetailInfoService->updateCompanyDetailData($id,$companiesdetailsAll);
    $companies = $this->AdminCompanyDetailInfoService->fetchCompanyDetailData($id);
    $prefectures = $this->AdminCompanyDetailInfoService->fetchPrefecturesCatsData();
    return view('kanri.admin.edit_admin_company_detail_info', compact('user','status','companies','prefectures'));

         }
 
         return view('kanri.registration.loginCompany');
 
     }


    // 会員企業管理削除画面の表示
    public function showdelEditAdminCompanyDetail($id)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        // 企業情報を取得する
        $companies = $this->AdminCompanyDetailInfoService->fetchCompanyDetailData($id);
        $prefectures = $this->AdminCompanyDetailInfoService->fetchPrefecturesCatsData();

        if ($user) {
            return view('kanri.admin.del_admin_company_detail_info', compact('user','companies','prefectures'));
        }

        return view('kanri.registration.loginCompany');
    }

    // 会員企業の削除
    public function deleteEditAdminCompanyDetailInfo(Request $request)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $delEditAdminCompanyInfo = $request->all();

        // 会社情報を削除する
        $this->AdminCompanyDetailInfoService->deleteCompanyDetailData($delEditAdminCompanyInfo);

        $status = "削除が完了しました";
        
        // 会社情報を取得する
        $companies = $this->AdminCompanyDetailInfoService->fetchCompanyDetailDataAll();
        if ($user) {
            return view('kanri.admin.admin_company_detail_info_data', compact('user','status','companies'));
        }

        return view('kanri.registration.loginCompany');
    }

}