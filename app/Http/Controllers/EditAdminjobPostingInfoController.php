<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\AdminjobPostingInfoService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;


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

    // 求人情報の更新
    public function updateEditAdminjobPostingInfo(Request $request)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = $request -> company_id;

        if ($user) {
            //パラメータの受け取る
            $jobPostings = $request->all();


         // バリデーションルール
        $rules = [
            'prefecuture_catch_head' => [
                'nullable',
                'regex:/^(?!.*[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}\x{1F1E6}-\x{1F1FF}\x{20000}-\x{2A6DF}\x{2A700}-\x{2B73F}\x{2B740}-\x{2B81F}\x{2B820}-\x{2CEAF}\x{2F800}-\x{2FA1F}]).*$/u', // 絵文字および特定のUnicode範囲の排除
            ],
    
            'prefecuture_catch_reading' => [
                'nullable',
                'regex:/^(?!.*[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}\x{1F1E6}-\x{1F1FF}\x{20000}-\x{2A6DF}\x{2A700}-\x{2B73F}\x{2B740}-\x{2B81F}\x{2B820}-\x{2CEAF}\x{2F800}-\x{2FA1F}]).*$/u', // 絵文字および特定のUnicode範囲の排除
            ],
            
            'prefecuture_image' => [
                'nullable',
                'mimes:jpeg,png' // 許可するファイルの拡張子を指定
            ],

            'addressDetail' => [
                'nullable',
                'regex:/^(?!.*[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}\x{1F1E6}-\x{1F1FF}\x{20000}-\x{2A6DF}\x{2A700}-\x{2B73F}\x{2B740}-\x{2B81F}\x{2B820}-\x{2CEAF}\x{2F800}-\x{2FA1F}]).*$/u', // 絵文字および特定のUnicode範囲の排除
            ],

            'working_hours' => [
                'nullable',
                'regex:/^(?!.*[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}\x{1F1E6}-\x{1F1FF}\x{20000}-\x{2A6DF}\x{2A700}-\x{2B73F}\x{2B740}-\x{2B81F}\x{2B820}-\x{2CEAF}\x{2F800}-\x{2FA1F}]).*$/u', // 絵文字および特定のUnicode範囲の排除
            ],

            'monthly_income' => [
                'nullable',
                'regex:/^(?!.*[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}\x{1F1E6}-\x{1F1FF}\x{20000}-\x{2A6DF}\x{2A700}-\x{2B73F}\x{2B740}-\x{2B81F}\x{2B820}-\x{2CEAF}\x{2F800}-\x{2FA1F}]).*$/u', // 絵文字および特定のUnicode範囲の排除
            ],

            'offer1_by_tel' => [
                'nullable',
                'regex:/^0\d{1,4}-?\d{1,4}-?\d{4}$/' // ハイフンあり・なし両方の形式チェック
            ],

            'offer1_by_form' => [
                'nullable',
                'url'  // URL形式チェック
            ],

            'offer2_by_tel' => [
                'nullable',
                'regex:/^0\d{1,4}-?\d{1,4}-?\d{4}$/' // ハイフンあり・なし両方の形式チェック
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
            'addressDetail.regex' => '勤務地の形式が正しくありません',
            'working_hours.regex' => '勤務時間の形式が正しくありません',
            'monthly_income.regex' => '初年度月収例の形式が正しくありません',
            'offer1_by_tel.regex' => '応募①電話の形式が正しくありません',
            'offer1_by_form.url' => '応募①フォームの形式が正しくありません',
            'offer2_by_tel.regex' => '応募②電話の形式が正しくありません',
            'offer2_by_form.url' => '応募➁フォームの形式が正しくありません',
        ];

        // バリデーション実行
        $validator = validator()->make($jobPostings, $rules, $messages);

        if ($validator->fails()) {

            $errors = $validator->errors()->toArray();
            //求人情報を取得する
            $jobPostings = $this->AdminjobPostingInfoService->fetchCompanyData($company_id);
            //全求人カテゴリを取得する
            $JobofferdetailCatAll = $this->AdminjobPostingInfoService->fetchJobofferdetailCatsData();
            //都道府県の情報を取得する
            $prefectures = $this->AdminjobPostingInfoService->fetchPrefecturesCatsData();
            
            return view('kanri.admin.edit_admin_jobPosting_info', compact('user','jobPostings','JobofferdetailCatAll','prefectures','errors'));
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
