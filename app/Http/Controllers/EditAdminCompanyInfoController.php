<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\AdminCompanyInfoService;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;

class EditAdminCompanyInfoController extends Controller
{

    private $AdminCompanyInfoService;
    public function __construct(AdminCompanyInfoService $AdminCompanyInfoService)
    {

    $this->AdminCompanyInfoService = $AdminCompanyInfoService;

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

    // 会員企業管理編集画面の表示
    public function showCreateAdminCompany()
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        //登録対象企業IDを取得
        $createCompany_id = $this->AdminCompanyInfoService->fetchCompanyId();

        if ($user) {
            return view('kanri.admin.create_admin_company_info', compact('user','createCompany_id'));
        }

        return view('kanri.registration.loginCompany');
    }

    //新規企業登録処理
    public function createEditAdminCompanyInfo(Request $request)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        $createEditAdminCompanyAll = $request->all();

        if ($user) {
            //新規企業IDの取得
            $createCompany_id = $createEditAdminCompanyAll['createCompany_id'];
            //受け取ったパラメータで企業詳細情報を登録する
            $company_name = $createEditAdminCompanyAll['company_name'];
            $company_name_kana = $createEditAdminCompanyAll['company_name_kana'];
            $email = $createEditAdminCompanyAll['email'];
            $email2 = $createEditAdminCompanyAll['email'];
            $email3 = $createEditAdminCompanyAll['email'];

            

            //必須項目が入力されている場合、実行
            if(!empty($company_name)&&!empty($company_name_kana)&&!empty($email)){
                
                //メールアドレス存在チェック
                $company = Company::where('email', $email)->first();
                if($company){
                    $request->session()->put('createEditAdminCompanyAll', $createEditAdminCompanyAll);
                    $status = 'このメールアドレス1は既に登録されています。';
                    return view('kanri.admin.create_admin_company_info', compact('user','createCompany_id','status'));
                }


                //新規登録処理
                $this->AdminCompanyInfoService->createCompanyInfo($createEditAdminCompanyAll);

                if(!empty($email)){
                    
                }

                $request->session()->put('createEditAdminCompanyAll', $createEditAdminCompanyAll);
                $status = '登録が完了しました';
                return view('kanri.admin.create_admin_company_info', compact('user','createCompany_id','status'));

            }else{

                $request->session()->put('createEditAdminCompanyAll', $createEditAdminCompanyAll);
                $status = '必須項目をすべて入力してください';
                return view('kanri.admin.create_admin_company_info', compact('user','createCompany_id','status'));
            }
        }

        return view('kanri.registration.loginCompany');
    }

    // 会員企業管理編集画面の表示
    public function showEditAdminCompany($id)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        // 会社情報を取得する
        $companies = $this->AdminCompanyInfoService->fetchCompanyInfoData($id);

        if ($user) {
            
            return view('kanri.admin.edit_admin_company_info', compact('user','companies'));
        }

        return view('kanri.registration.loginCompany');
    }

    // 会員企業管理画面の更新
    public function updateEditAdminCompanyInfo(Request $request)
    {
        // ユーザIDから企業名を取得する
        $user = Session::get('user');
        $updateEditAdminCompanyInfo = $request->all();

        
        // バリデーションルール
        $rules = [
            'company_name' => [
                'required',
                'regex:/^[a-zA-Z0-9ａ-ｚＡ-Ｚ０-９ぁ-んァ-ヶ一-龥々ー\s\-]+$/u' // 求人情報キャッチの形式チェック（許可される文字: 英数字、全角ひらがな、全角カタカナ、漢字、スペース、ハイフン）
            ],
            'company_name_kana' => [
                'nullable',
                'regex:/^[a-zA-Z0-9ｱ-ﾝｧ-ｫｬ-ｮｰﾞﾟａ-ｚＡ-Ｚ０-９ァ-ヶー\s\-]+$/u' // 英数字、半角カナ、全角カナ、スペース、ハイフンのみ許可
            ],
            'email' => [
                'required',
                'email'
            ],
            'email2' => [
                'nullable',
                'email'
            ],
            'email3' => [
                'nullable',
                'email'
            ],
        ];

        // カスタムメッセージ
        $messages = [
            'company_name.required' => '企業名は必須です',
            'company_name.regex' => '企業名の形式が正しくありません',
            'company_name_kana.regex' => '企業名カナの形式が正しくありません',
            'email.required' => 'メールアドレスは必須です',
            'email.email' => 'メールアドレスの形式が正しくありません',
            'email2.email' => 'メールアドレス2の形式が正しくありません',
            'email3.email' => 'メールアドレス3の形式が正しくありません',
        ];

        // バリデーション実行
        $validator = validator()->make($updateEditAdminCompanyInfo, $rules, $messages);

        if ($validator->fails()) {
            $status = $validator->errors()->first();
            // 会社情報を取得する
            $companies = $this->AdminCompanyInfoService->fetchCompanyInfoData($updateEditAdminCompanyInfo['company_id']);
            
            // ビューを返す
            if ($user) {
                return view('kanri.admin.edit_admin_company_info', compact('user', 'companies', 'status'));
            }
            return view('kanri.registration.loginCompany');
        }

        //企業存在チェック
        $email = $updateEditAdminCompanyInfo["email"];
        $email2 = $updateEditAdminCompanyInfo["email2"];
        $email3 = $updateEditAdminCompanyInfo["email3"];
        $company_id = $updateEditAdminCompanyInfo["company_id"];

        // dd($companyCheck);

        //postされたメールアドレスが互いに重複していないか
        // 入力されたメールアドレスが互いに重複していないか
        if ($email === $email2 || $email === $email3 || (!empty($email2) && $email2 === $email3)) {
            $companies = $this->AdminCompanyInfoService->fetchCompanyInfoData($company_id);
            $status = "入力されたメールアドレスが互いに重複しています。";
            // ビューを返す
            if ($user) {
                return view('kanri.admin.edit_admin_company_info', compact('user', 'companies', 'status'));
            }
            return view('kanri.registration.loginCompany');
        }

        // クエリ結果を格納する配列を初期化
        $queries = [];

        // 各メールアドレスがnullでない場合にクエリを実行
        if ($email !== null) {
            $queries[] = Company::where('email', $email)->where('company_id', '!=', $company_id)->exists();
            $queries[] = Company::where('email2', $email)->where('company_id', '!=', $company_id)->exists();
            $queries[] = Company::where('email3', $email)->where('company_id', '!=', $company_id)->exists();
        }

        if ($email2 !== null) {
            $queries[] = Company::where('email', $email2)->where('company_id', '!=', $company_id)->exists();
            $queries[] = Company::where('email2', $email2)->where('company_id', '!=', $company_id)->exists();
            $queries[] = Company::where('email3', $email2)->where('company_id', '!=', $company_id)->exists();
        }

        if ($email3 !== null) {
            $queries[] = Company::where('email', $email3)->where('company_id', '!=', $company_id)->exists();
            $queries[] = Company::where('email2', $email3)->where('company_id', '!=', $company_id)->exists();
            $queries[] = Company::where('email3', $email3)->where('company_id', '!=', $company_id)->exists();
        }

        // どれかのクエリがtrueなら重複しているデータが存在する
        if (in_array(true, $queries, true)) {
            $companies = $this->AdminCompanyInfoService->fetchCompanyInfoData($company_id);
            $status = "重複しているメールアドレスが存在します。";

            // sessionにデータが入っている場合、画面描画の処理を行う
            // ビューを返す
            if ($user) {
                return view('kanri.admin.edit_admin_company_info', compact('user', 'companies', 'status'));
            }

            return view('kanri.registration.loginCompany');
        }

    
        // 成功した場合の処理
        $this->AdminCompanyInfoService->updateCompanyDetailData($updateEditAdminCompanyInfo);
        $companies = $this->AdminCompanyInfoService->fetchCompanyInfoData($company_id);
        $status = "更新が完了しました";

        // ビューを返す
        if ($user) {
            return view('kanri.admin.edit_admin_company_info', compact('user', 'companies', 'status'));
        }

        return view('kanri.registration.loginCompany');
    }

    // 会員企業管理削除画面の表示
    public function showdelEditAdminCompany($id)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        // 会社情報を取得する
        $companies = $this->AdminCompanyInfoService->fetchCompanyInfoData($id);

        if ($user) {
            
            return view('kanri.admin.del_admin_company_info', compact('user','companies'));
        }

        return view('kanri.registration.loginCompany');
    }
    
    // 会員企業の削除
    public function deleteEditAdminCompanyInfo(Request $request)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $delEditAdminCompanyInfo = $request->all();
        // 会社情報を削除する
        $this->AdminCompanyInfoService->deleteCompanyDetailData($delEditAdminCompanyInfo);

        $status = "削除が完了しました";
        
        // 会社情報を取得する
        $companies = $this->AdminCompanyInfoService->fetchCompanyDetailData();
        if ($user) {
            return view('kanri.admin.admin_company_info_data', compact('user','status','companies'));
        }

        return view('kanri.registration.loginCompany');
    }


}
