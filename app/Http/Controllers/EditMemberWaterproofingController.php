<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Support\Facades\Session;
use App\Services\MemberWaterproofingManagementService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class EditMemberWaterproofingController extends Controller
{
    private $MemberWaterproofingManagementService;
    
    public function __construct(MemberWaterproofingManagementService $MemberWaterproofingManagementService)
    {
        $this->MemberWaterproofingManagementService = $MemberWaterproofingManagementService;
    }

    // お問い合わせトップ画面を表示
    public function index()
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        //ログインユーザに紐づく防水工事情報を取得する
        $worterProofs = $this->MemberWaterproofingManagementService->fetchCompanyData($company_id);
        //全工事カテゴリを取得する
        $worterProofCatAll = $this->MemberWaterproofingManagementService->fetchWaterProofingCatData();


        if ($user) {
            return view('kanri.member.edit_member_waterproofing', compact('user','worterProofs','worterProofCatAll'));
        }

        return view('showCpmanyLoginForm');
    }
    //更新ボタン押下処理
    public function updateWaterProofingInfo(Request $request)
    {

        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        //パラメータの受け取る
        $waterProofingAll = $request->all();
        //カテゴリがPOSTされていない場合は、終了
        if (!isset($waterProofingAll['WaterProofingCat']) || !is_array($waterProofingAll['WaterProofingCat'])) {
            return redirect()->route('ecoulex.kanri.editMemberWaterproofing')->with('status', '防水工事募集内容は必須です');
        }


        // バリデーションルール
        $rules = [
            'waterproofing_job_catch' => [
                'nullable',
                'regex:/^[a-zA-Z0-9ａ-ｚＡ-Ｚ０-９ぁ-んァ-ヶ一-龥々ー\s\-]+$/u' // 所在地の形式チェック（許可される文字: 英数字、全角ひらがな、全角カタカナ、漢字、スペース、ハイフン）
            ],
    
            'waterproofing_job_description' => [
                'nullable',
                'regex:/^[a-zA-Z0-9ａ-ｚＡ-Ｚ０-９ぁ-んァ-ヶ一-龥々ー\s\-]+$/u' // 社員数の形式チェック（許可される文字: 英数字、全角ひらがな、全角カタカナ、漢字、スペース、ハイフン）
            ],
            
            'waterproofing_job_image' => [
                'mimes:jpeg,png' // 許可するファイルの拡張子を指定
            ],
        ];

        // カスタムメッセージ
        $messages = [
            'waterproofing_job_catch.regex' => '防水工事用キャッチの形式が正しくありません',
            'waterproofing_job_description.regex' => '防水工事用詳細の形式が正しくありません',
            'waterproofing_job_image.mimes' => '許可されていないファイル形式です。jpeg, pngのファイルのみ許可されています。',
        ];

        // バリデーション実行
        $validator = validator()->make($waterProofingAll, $rules, $messages);
        
        if ($validator->fails()) {
            $status = $validator->errors()->first();
            return redirect()->route('ecoulex.kanri.editMemberWaterproofing')->with('status', $status);
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

            //ログイン情報に紐づく求人情報のレコードを取得する
            $waterProofingRec = $this->MemberWaterproofingManagementService->fetchWaterProofingData($company_id);
            
            if($waterProofingRec->count() == 0){
            //求人情報が存在しない場合は登録処理を行う
                $this->MemberWaterproofingManagementService->insertWaterProofingData($company_id,$waterProofingAll,$filename);
            }else{
            //求人情報が存在するばあいは更新処理を行う
                $this->MemberWaterproofingManagementService->updateWaterProofingData($company_id,$waterProofingAll,$filename);
            }
            
            return redirect()->route('ecoulex.kanri.editMemberWaterproofing')->with('status', '更新が完了しました');
        }
        return view('kanri.registration.loginCompany');

    }
    

}
