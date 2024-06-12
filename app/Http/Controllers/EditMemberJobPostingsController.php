<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Support\Facades\Session;
use App\Services\MemberJobPostingsService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;


class EditMemberJobPostingsController extends Controller
{
    private $MemberJobPostingsService;
    
    public function __construct(MemberJobPostingsService $MemberJobPostingsService)
    {
        $this->MemberJobPostingsService = $MemberJobPostingsService;
    }
    // お問い合わせトップ画面を表示
    public function index()
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        //求人情報を取得する
        $jobPostings = $this->MemberJobPostingsService->fetchCompanyData($company_id);
        //全求人カテゴリを取得する
        $JobofferdetailCatAll = $this->MemberJobPostingsService->fetchJobofferdetailCatsData();
        //都道府県の情報を取得する
        $prefectures = $this->MemberJobPostingsService->fetchPrefecturesCatsData();

        if ($user) {
            return view('kanri.member.edit_member_job_postings', compact('user','jobPostings','JobofferdetailCatAll','prefectures'));
        }

        return view('kanri.registration.loginCompany');
    }

    public function updateJobPostingInfo(Request $request)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');
        
        if ($user) {
            //パラメータの受け取る
            $jobPostingAll = $request->all();

                     // バリデーションルール
        $rules = [
            'prefecuture_catch_head' => [
                'nullable',
                'regex:/^[a-zA-Z0-9ａ-ｚＡ-Ｚ０-９ぁ-んァ-ヶ一-龥々ー\s\-]+$/u' // 求人情報キャッチの形式チェック（許可される文字: 英数字、全角ひらがな、全角カタカナ、漢字、スペース、ハイフン）
            ],
    
            'prefecuture_catch_reading' => [
                'nullable',
                'regex:/^[a-zA-Z0-9ａ-ｚＡ-Ｚ０-９ぁ-んァ-ヶ一-龥々ー\s\-]+$/u' // 求人情報詳細の形式チェック（許可される文字: 英数字、全角ひらがな、全角カタカナ、漢字、スペース、ハイフン）
            ],
            
            'prefecuture_image' => [
                'nullable',
                'mimes:jpeg,png' // 許可するファイルの拡張子を指定
            ],

            'addressDetail' => [
                'nullable',
                'regex:/^[a-zA-Z0-9ａ-ｚＡ-Ｚ０-９ぁ-んァ-ヶ一-龥々ー\s\-]+$/u' // 勤務地の形式チェック（許可される文字: 英数字、全角ひらがな、全角カタカナ、漢字、スペース、ハイフン）
            ],

            'working_hours' => [
                'nullable',
                'regex:/^[a-zA-Z0-9ａ-ｚＡ-Ｚ０-９ぁ-んァ-ヶ一-龥々ー\s\-]+$/u' // 勤務時間の形式チェック（許可される文字: 英数字、全角ひらがな、全角カタカナ、漢字、スペース、ハイフン）
            ],

            'monthly_income' => [
                'nullable',
                'regex:/^[a-zA-Z0-9ａ-ｚＡ-Ｚ０-９ぁ-んァ-ヶ一-龥々ー\s\-]+$/u' // 初年度月収例の形式チェック（許可される文字: 英数字、全角ひらがな、全角カタカナ、漢字、スペース、ハイフン）
            ],

            'offer1_by_tel' => [
                'nullable',
                'regex:/^0\d{1,4}-\d{1,4}-\d{4}$/' // 電話番号の形式チェック
            ],

            'offer1_by_form' => [
                'nullable',
                'url'  // URL形式チェック
            ],

            'offer2_by_tel' => [
                'nullable',
                'regex:/^0\d{1,4}-\d{1,4}-\d{4}$/' // 電話番号の形式チェック
            ],

            'offer2_by_form' => [
                'nullable',
                'url'  // URL形式チェック
            ],
        ];


        // カスタムメッセージ
        $messages = [
            'prefecuture_catch_head.regex' => '求人情報キャッチの形式が正しくありません',
            'prefecuture_catch_reading.regex' => '求人情報詳細の形式が正しくありません',
            'prefecuture_image.mimes' => '求人用画像は許可されていないファイル形式です。jpeg, pngのファイルのみ許可されています。',
            'addressDetail.regex' => '勤務地キャッチの形式が正しくありません',
            'working_hours.regex' => '勤務時間の形式が正しくありません',
            'monthly_income.regex' => '初年度月収例の形式が正しくありません',
            'offer1_by_tel.regex' => '応募①電話の形式が正しくありません',
            'offer1_by_form.regex' => '応募①フォームの形式が正しくありません',
            'offer1_by_form.url' => '応募①フォームの形式が正しくありません',
            'offer2_by_tel.regex' => '応募②電話の形式が正しくありません',
            'offer2_by_form.url' => '応募➁フォームの形式が正しくありません',
        ];

        // バリデーション実行
        $validator = validator()->make($jobPostingAll, $rules, $messages);

        if ($validator->fails()) {

            $status = $validator->errors()->first();
            return redirect()->route('ecoulex.kanri.editMemberJobPostings')->with('status', $status);
        }

            
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
            $jobPostingsRec = $this->MemberJobPostingsService->fetchJobPostingData($company_id);
            
            if($jobPostingsRec->count() == 0){
            //求人情報が存在しない場合は登録処理を行う
                $this->MemberJobPostingsService->insertJobPostingData($company_id,$jobPostingAll,$filename);
            }else{
            //求人情報が存在するばあいは更新処理を行う
                $this->MemberJobPostingsService->updateJobPostingData($company_id,$jobPostingAll,$filename);
            }
            
            return redirect()->route('ecoulex.kanri.editMemberJobPostings')->with('status', '更新が完了しました');
        }
        return view('kanri.registration.loginCompany');

    }

}
