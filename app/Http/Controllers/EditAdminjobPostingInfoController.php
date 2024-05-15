<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\AdminjobPostingInfoService;


class EditAdminjobPostingInfoController extends Controller
{

    private $AdminjobPostingInfoService;
    public function __construct(AdminjobPostingInfoService $AdminjobPostingInfoService)
    {

    $this->AdminjobPostingInfoService = $AdminjobPostingInfoService;

    }

    // 会員企業管理編集画面の表示
    public function showAdminjobPostingInfo($id)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        //求人情報を取得する
        $jobPostings = $this->AdminjobPostingInfoService->fetchCompanyData($id);
        //全求人カテゴリを取得する
        $JobofferdetailCatAll = $this->AdminjobPostingInfoService->fetchJobofferdetailCatsData();
        //都道府県の情報を取得する
        $prefectures = $this->AdminjobPostingInfoService->fetchPrefecturesCatsData();


        if ($user) {
            return view('kanri.admin.edit_admin_jobPosting_info', compact('user','jobPostings','JobofferdetailCatAll','prefectures'));
        }

        return view('kanri.registration.loginCompany');
    }

    // 会員企業管理画面の更新
    public function updateEditAdminjobPostingInfo(Request $request)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = $request -> company_id;

        if ($user) {
            //パラメータの受け取る
            $jobPostings = $request->all();
            
            //パラメータの中に画像ファイルがあった場合、uploadsフォルダに画像を格納する
            if ($request->hasFile('prefecuture_image')) {
                //既存のファイルを削除する
                $filenameTodel = "/^jobPosting_{$company_id}_/";
                $files = Storage::disk('public')->files('uploads'); // ストレージディレクトリ内の全ファイルを取得
                foreach ($files as $file) {
                    if (preg_match($filenameTodel, basename($file))) {
                        Storage::disk('public')->delete($file); // ファイルを削除
                    }
                }
                
                //ファイルをアップロードする
                $prefecuture_image_up = $request->file('prefecuture_image');
                $datetime = Carbon::now()->format('YmdHisv');
                $filename = 'jobPosting_' . $company_id . '_' . $datetime . '.' . $prefecuture_image_up->getClientOriginalExtension();
                $prefecuture_image_up->storeAs('uploads', $filename, 'public');
            }else{
                $filename = "";
            }



            //ログイン情報に紐づく求人情報のレコードを取得する
            $jobPostingsRec = $this->AdminjobPostingInfoService->fetchJobPostingData($company_id);
            
            if($jobPostingsRec->count() == 0){
            //求人情報が存在しない場合は登録処理を行う
                $this->AdminjobPostingInfoService->insertJobPostingData($company_id,$jobPostings,$filename);
            }else{
            //求人情報が存在するばあいは更新処理を行う
                $this->AdminjobPostingInfoService->updateJobPostingData($company_id,$jobPostings,$filename);
            }

             //求人情報を取得する
            $jobPostings = $this->AdminjobPostingInfoService->fetchCompanyData($company_id);
            //全求人カテゴリを取得する
            $JobofferdetailCatAll = $this->AdminjobPostingInfoService->fetchJobofferdetailCatsData();
            //都道府県の情報を取得する
            $prefectures = $this->AdminjobPostingInfoService->fetchPrefecturesCatsData();
            
            $status = "更新が完了しました";
            return view('kanri.admin.edit_admin_jobPosting_info', compact('user','jobPostings','JobofferdetailCatAll','prefectures','status'));
        }
        return view('kanri.registration.loginCompany');
    }

        // 会員企業管理編集画面の表示
        public function showdelAdminjobPostingInfo($id)
        {
            //ユーザIDから企業名を取得する
            $user = Session::get('user');
            $company_id = Session::get('company_id');
    
    
    
            //求人情報を取得する
            $jobPostings = $this->AdminjobPostingInfoService->fetchCompanyData($id);
            //全求人カテゴリを取得する
            $JobofferdetailCatAll = $this->AdminjobPostingInfoService->fetchJobofferdetailCatsData();
            //都道府県の情報を取得する
            $prefectures = $this->AdminjobPostingInfoService->fetchPrefecturesCatsData();

    
            if ($user) {
                return view('kanri.admin.del_admin_jobPosting_info', compact('user','jobPostings','JobofferdetailCatAll','prefectures'));
            }
    
            return view('kanri.registration.loginCompany');
        }

    

    // 求人情報の削除
    public function delEditAdminjobPostingInfo(Request $request)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $delEditAdminCompanyInfo = $request->all();
        // 会社情報を削除する
        $this->AdminjobPostingInfoService->deleteAdminjobPostingData($delEditAdminCompanyInfo);

        $status = "削除が完了しました";
        $company_id = $delEditAdminCompanyInfo['company_id'];

        // 求人情報を取得する
        $jobPostings = $this->AdminjobPostingInfoService->fetchCompanyDetailData();

        // sessionにデータが入っている場合、画面描画の処理を行う    
        if ($user) {            
            return view('kanri.admin.admin_jobPosting_info_data', compact('user','jobPostings','status'));
        }
        // sessionにデータが入っていない（有効期限切れ）場合、ログイン画面に遷移する
        return view('kanri.registration.loginCompany');
    }

}
