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

         //必須項目が入力されている場合、実行
         if(!empty($address_num)&&!empty($prefectureId)&&!empty($addressDetail)&&!empty($representative)){

            $status = '更新が完了しました';
            $this->AdminCompanyDetailInfoService->updateCompanyDetailData($id,$companiesdetailsAll);
            $companies = $this->AdminCompanyDetailInfoService->fetchCompanyDetailData($id);
            $prefectures = $this->AdminCompanyDetailInfoService->fetchPrefecturesCatsData();
            return view('kanri.admin.edit_admin_company_detail_info', compact('user','status','companies','prefectures'));

         }else{

            $companies = $this->AdminCompanyDetailInfoService->fetchCompanyDetailData($id);
            $prefectures = $this->AdminCompanyDetailInfoService->fetchPrefecturesCatsData();
            $status = '必須項目をすべて入力してください';
            return view('kanri.admin.edit_admin_company_detail_info', compact('user','status','companies','prefectures'));
         }
         
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