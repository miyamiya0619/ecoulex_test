<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\AdminCompanyMailListService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Str;
use App\Models\Company;
use App\Mail\sendMail;


class AdminCompanyMailListController extends Controller
{

    private $AdminCompanyMailListService;

    public function __construct(AdminCompanyMailListService $AdminCompanyMailListService)
    {

    $this->AdminCompanyMailListService = $AdminCompanyMailListService;

    }
    // お問い合わせトップ画面を表示
    public function index()
    {
        //ログイン後の取得したセッション情報を取り出す
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        $companies = Company::paginate(10);

        $emailsAndNames = [];

        foreach ($companies as $company) {
            if ($company->email) {
            $emailsAndNames[] = ['company_id' => $company->company_id, 'email' => $company->email, 'company_name' => $company->company_name, 'm_id' => 1];
            }
            if ($company->email2) {
            $emailsAndNames[] = ['company_id' => $company->company_id, 'email' => $company->email2, 'company_name' => $company->company_name, 'm_id' => 2];
            }
            if ($company->email3) {
            $emailsAndNames[] = ['company_id' => $company->company_id, 'email' => $company->email3, 'company_name' => $company->company_name, 'm_id' => 3];
            }
        }

        // sessionにデータが入っている場合、画面描画の処理を行う
        if ($user) {
            return view('kanri.admin.admin_company_mailList_data', compact('user','emailsAndNames','companies'));
        }
        // sessionにデータが入っていない（有効期限切れ）場合、ログイン画面に遷移する
        return view('kanri.registration.loginCompany');
    }


    //フリーワード検索処理
    public function mailListSearch(Request $request)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $companyLoginT = Session::get('companyLoginT');
        $user_type = Session::get('user_type');

        if ($user) {
        //パラメータの受け取る
        $resultData = $request->all();
        $search_freeword = $resultData['search_freeword'];
        $emailsAndNames = [];

        //フリーワードに値が入力されていない場合はメッセージを表示する
        if(empty($search_freeword)){
            
            $companies = Company::paginate(10);
            
            foreach ($companies as $company) {
                if ($company->email) {
                $emailsAndNames[] = ['company_id' => $company->company_id, 'email' => $company->email, 'company_name' => $company->company_name, 'm_id' => 1];
                }
                if ($company->email2) {
                $emailsAndNames[] = ['company_id' => $company->company_id, 'email' => $company->email2, 'company_name' => $company->company_name, 'm_id' => 2];
                }
                if ($company->email3) {
                $emailsAndNames[] = ['company_id' => $company->company_id, 'email' => $company->email3, 'company_name' => $company->company_name, 'm_id' => 3];
                }
            }

            $status = 'フリーワードを入力してください';
            return view('kanri.admin.admin_company_mailList_data', compact('user','emailsAndNames','companies','status'));

        }

        //検索結果のレコードを取得する
        $query = Company::query();
        $query->where('company_name', 'LIKE', '%' . $search_freeword . '%')
              ->orWhere('email', 'LIKE', '%' . $search_freeword . '%')
              ->orWhere('email2', 'LIKE', '%' . $search_freeword . '%')
              ->orWhere('email3', 'LIKE', '%' . $search_freeword . '%');
        $companies = $query->paginate(10);

        foreach ($companies as $company) {
            if ($company->email) {
            $emailsAndNames[] = ['company_id' => $company->company_id, 'email' => $company->email, 'company_name' => $company->company_name, 'm_id' => 1];
            }
            if ($company->email2) {
            $emailsAndNames[] = ['company_id' => $company->company_id, 'email' => $company->email2, 'company_name' => $company->company_name, 'm_id' => 2];
            }
            if ($company->email3) {
            $emailsAndNames[] = ['company_id' => $company->company_id, 'email' => $company->email3, 'company_name' => $company->company_name, 'm_id' => 3];
            }
        }


        return view('kanri.admin.admin_company_mailList_data', compact('user','emailsAndNames','companies','search_freeword'));
    }
        return view('kanri.registration.loginCompany');
    }
    

    //メールリスト編集画面
    public function editmailList($id,$m_id)
    {
        //ログイン後の取得したセッション情報を取り出す
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        $mailList = $this->AdminCompanyMailListService->fetchCompanyMailList($id,$m_id);

        // sessionにデータが入っている場合、画面描画の処理を行う
        if ($user) {
            return view('kanri.admin.edit_admin_company_mailList_data', compact('user','mailList','m_id'));
        }
        // sessionにデータが入っていない（有効期限切れ）場合、ログイン画面に遷移する
        return view('kanri.registration.loginCompany');
    }

    //メールアドレスリスト更新画面
    public function updateEditmailList(Request $request)
    {
        //ログイン後の取得したセッション情報を取り出す
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        $mailListArr = $request->all();
        
        $id = $request -> company_id; 
        $m_id = $request -> m_id;
        $mail = $request -> email;


        // バリデーションルール
        $rules = [
            'email' => [
                'required',
                'email'
            ],
        ];
        // カスタムメッセージ
        $messages = [
            'email.required' => 'メールアドレスは必須です',
            'email.email' => 'メールアドレスの形式が正しくありません',
        ];
        // バリデーション実行
        $validator = validator()->make($mailListArr, $rules, $messages);

        if ($validator->fails()) {
            $status = $validator->errors()->first();
            // 会社情報を取得する
            $mailList = $this->AdminCompanyMailListService->fetchCompanyMailList($id, $m_id);
            
            // sessionにデータが入っている場合、画面描画の処理を行う
            if ($user) {
                return view('kanri.admin.edit_admin_company_mailList_data', compact('user','mailList','m_id','status'));
            }
            // sessionにデータが入っていない（有効期限切れ）場合、ログイン画面に遷移する
            return view('kanri.registration.loginCompany');
        }

        //存在チェック
        $company = Company::where('email', $mail)->where('company_id', '!=', $id)->first();
        $company2 = Company::where('email2', $mail)->where('company_id', '!=', $id)->first();
        $company3 = Company::where('email3', $mail)->where('company_id', '!=', $id)->first();
        if (!empty($company) || !empty($company2) || !empty($company3)) {
            $status = "このメールアドレスは既に存在しています。";
            // 会社情報を取得する
            $mailList = $this->AdminCompanyMailListService->fetchCompanyMailList($id, $m_id);
            
            // sessionにデータが入っている場合、画面描画の処理を行う
            if ($user) {
                return view('kanri.admin.edit_admin_company_mailList_data', compact('user','mailList','m_id','status'));
            }
            // sessionにデータが入っていない（有効期限切れ）場合、ログイン画面に遷移する
            return view('kanri.registration.loginCompany');
        }

        //エラーがない場合

            $this->AdminCompanyMailListService->updateCompanyMailList($id, $m_id, $mail);
            //メール一覧情報の取得
            $mailList = $this->AdminCompanyMailListService->fetchCompanyMailList($id, $m_id);
            $status = "更新が完了しました";
   
        // sessionにデータが入っている場合、画面描画の処理を行う
        if ($user) {
            return view('kanri.admin.edit_admin_company_mailList_data', compact('user','mailList','m_id','status'));
        }
        // sessionにデータが入っていない（有効期限切れ）場合、ログイン画面に遷移する
        return view('kanri.registration.loginCompany');
    }

    //メールリスト削除画面
    public function delmailList($id,$m_id)
    {
        //ログイン後の取得したセッション情報を取り出す
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        $mailList = $this->AdminCompanyMailListService->fetchCompanyMailList($id,$m_id);

        // sessionにデータが入っている場合、画面描画の処理を行う
        if ($user) {
            return view('kanri.admin.del_admin_company_mailList_data', compact('user','mailList','m_id'));
        }
        // sessionにデータが入っていない（有効期限切れ）場合、ログイン画面に遷移する
        return view('kanri.registration.loginCompany');
    }

    //メールアドレスリスト削除処理
    public function deleteEditmailList(Request $request)
    {
        //ログイン後の取得したセッション情報を取り出す
        $user = Session::get('user');
        $company_id = Session::get('company_id');
        
        $id = $request -> company_id; 
        $m_id = $request -> m_id;
        $mail = $request -> email;

        $this->AdminCompanyMailListService->deleteCompanyMailList($id,$m_id);

        //メール一覧情報の取得
        $mailList = $this->AdminCompanyMailListService->fetchCompanyMailList($id,$m_id);

        $status = "削除が完了しました";

        // sessionにデータが入っている場合、画面描画の処理を行う
        if ($user) {
            return view('kanri.admin.edit_admin_company_mailList_data', compact('user','mailList','m_id','status'));
        }
        // sessionにデータが入っていない（有効期限切れ）場合、ログイン画面に遷移する
        return view('kanri.registration.loginCompany');
    }


    
}
