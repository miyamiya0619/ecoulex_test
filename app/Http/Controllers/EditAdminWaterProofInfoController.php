<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\AdminWaterProofInfoService;


class EditAdminWaterProofInfoController extends Controller
{

    private $AdminWaterProofInfoService;
    public function __construct(AdminWaterProofInfoService $AdminWaterProofInfoService)
    {

    $this->AdminWaterProofInfoService = $AdminWaterProofInfoService;

    }

    // 会員企業管理編集画面の表示
    public function showAdminWaterProofInfo($id)
    {
         //ユーザIDから企業名を取得する
         $user = Session::get('user');
         $company_id = Session::get('company_id');
 
         //防水工事情報を取得する
         $WarterProofs = $this->AdminWaterProofInfoService->fetchCompanyData($id);
         //全工事カテゴリを取得する
         $WarterProofCatAll = $this->AdminWaterProofInfoService->fetchWaterProofingCatData();
 
         if ($user) {
             return view('kanri.admin.edit_admin_waterproofing', compact('user','WarterProofs','WarterProofCatAll'));
         }
 
         return view('showCpmanyLoginForm');
    }

    //更新ボタン押下処理
    public function updateEditAdminWaterProofInfo(Request $request)
    {

        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');



        //パラメータの受け取る
        $waterProofingAll = $request->all();
        $id = $waterProofingAll['company_id'];


     //カテゴリがPOSTされていない場合は、終了
        if (!isset($waterProofingAll['WaterProofingCat']) || !is_array($waterProofingAll['WaterProofingCat'])) {

            return redirect()->route('ecoulex.kanri.updateEditAdminWaterProofInfo')->with('status', '必須項目をすべて入力してください');
        }

        
        if ($user) {
            
            //パラメータの中に画像ファイルがあった場合、uploadsフォルダに画像を格納する
            if ($request->hasFile('waterproofing_job_image')) {
                //既存のファイルを削除する
                $filenameTodel = "/^waterProofing_{$company_id}_/";
                $files = Storage::disk('public')->files('uploads'); // ストレージディレクトリ内の全ファイルを取得
                foreach ($files as $file) {
                    if (preg_match($filenameTodel, basename($file))) {
                        Storage::disk('public')->delete($file); // ファイルを削除
                    }
                }
                //ファイルをアップロードする
                $waterproofing_job_image_up = $request->file('waterproofing_job_image');
                $datetime = Carbon::now()->format('YmdHisv');
                $filename = 'waterProofing_' . $company_id . '_' . $datetime . '.' . $waterproofing_job_image_up->getClientOriginalExtension();
                $waterproofing_job_image_up->storeAs('uploads', $filename, 'public');
            }else{
                $filename = "";
            }

                     //ログインユーザに紐づく防水工事情報を取得する
            $WarterProofs = $this->AdminWaterProofInfoService->fetchCompanyData($id);
                     //全工事カテゴリを取得する
            $WarterProofCatAll = $this->AdminWaterProofInfoService->fetchWaterProofingCatData();
 
            //ログイン情報に紐づく防水情報のレコードを取得する
            $waterProofingRec = $this->AdminWaterProofInfoService->fetchWaterProofingData($id);
            
            if($waterProofingRec->count() == 0){
            //求人情報が存在しない場合は登録処理を行う
                $this->AdminWaterProofInfoService->insertWaterProofingData($id,$waterProofingAll,$filename);
            }else{
            //求人情報が存在するばあいは更新処理を行う
                $this->AdminWaterProofInfoService->updateWaterProofingData($id,$waterProofingAll,$filename);
            }

            //ログインユーザに紐づく防水工事情報を取得する
            $WarterProofs = $this->AdminWaterProofInfoService->fetchCompanyData($id);
            //全工事カテゴリを取得する
            $WarterProofCatAll = $this->AdminWaterProofInfoService->fetchWaterProofingCatData();


            $status = "更新が完了しました";
            return view('kanri.admin.edit_admin_waterproofing', compact('user','WarterProofs','WarterProofCatAll','status'));

        }
        return view('kanri.registration.loginCompany');

    }

    // 会員企業管理削除確認画面の表示
    public function showdelAdminWaterProofInfo($id)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        //ログインユーザに紐づく防水工事情報を取得する
        $WarterProofs = $this->AdminWaterProofInfoService->fetchCompanyData($id);
        //全工事カテゴリを取得する
        $WarterProofCatAll = $this->AdminWaterProofInfoService->fetchWaterProofingCatData();

        if ($user) {
            return view('kanri.admin.del_admin_waterproofing', compact('user','WarterProofs','WarterProofCatAll'));
        }

        return view('kanri.registration.loginCompany');

    }

    // 求人情報の削除
    public function delEditAdminWaterProofInfo(Request $request)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $delEditAdminCompanyInfo = $request->all();
        // 会社情報を削除する
        $this->AdminWaterProofInfoService->deleteAdminWaterProofData($delEditAdminCompanyInfo);

        $status = "削除が完了しました";
        $company_id = $delEditAdminCompanyInfo['company_id'];

        // 会社情報を取得する
        $waterproofs = $this->AdminWaterProofInfoService->fetchCompanyDetailData();

        // sessionにデータが入っている場合、画面描画の処理を行う
        if ($user) {            
            return view('kanri.admin.admin_waterProof_info_data', compact('user','waterproofs','status'));
        }
        // sessionにデータが入っていない（有効期限切れ）場合、ログイン画面に遷移する
        return view('kanri.registration.loginCompany');
    }
        
}
