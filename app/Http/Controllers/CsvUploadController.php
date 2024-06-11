<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Company;
use App\Models\Companiesdetail;
use App\Mail\ForgetdMail;
use App\Services\AdminCsvImportService;
use Illuminate\Support\Facades\DB;
use App\Models\Waterproof;
use App\Models\Joboffer;

class CsvUploadController extends Controller
{
    private $AdminCsvImportService;
    public function __construct(AdminCsvImportService $AdminCsvImportService)
    {

    $this->AdminCsvImportService = $AdminCsvImportService;

    }
    public function showcsvUpload()
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        if ($user) {
            return view('kanri.admin.show_csv_upload', compact('user'));
        }
        return view('kanri.registration.loginCompany');
    }

    // //会員企業情報CSV登録
    // public function importCompaniesCsv(Request $request)
    // {
    //     $user = Session::get('user');
    //     $company_id = Session::get('company_id');
        
    //     //セッションが切れた場合
    //     if (!$user) {
    //         return view('kanri.registration.loginCompany');
    //     }

    //     // リクエストからファイルを取得
    //     $file = $request->file('companies_csv_file');
    //     if($file){
    //         $fileName = $file->getClientOriginalName();
    //     }
       
    //     $searchString = '会員情報（会員企業管理画面）';
    //     //ファイル存在チェック
    //     if (!($request->hasFile('companies_csv_file')) || strpos($fileName, $searchString) === false) {
    //         $status = "会員企業登録用ファイルを選択してください";
    //         return view('kanri.admin.show_csv_upload', compact('user','status'));
    //     }

    //     $path = $file->getRealPath();
    //     $fp = fopen($path, 'r');
    //     fgetcsv($fp);

    //     // 1行ずつ読み込み、企業テーブルに登録する
    //     while (($csvData = fgetcsv($fp)) !== FALSE) {
    //         $this->AdminCsvImportService->InsertCompaniesCsvData($csvData);
    //     }
    //     // ファイルを閉じる
    //     fclose($fp);
    //     $status = "会員企業登録用ファイルの取り込みが完了しました。";
    //     return view('kanri.admin.show_csv_upload', compact('user','status'));
    // }

//会員企業情報CSV登録
public function importCompaniesCsv(Request $request)
{
    $user = Session::get('user');
    $company_id = Session::get('company_id');

    // セッションが切れた場合
    if (!$user) {
        return view('kanri.registration.loginCompany');
    }

    // リクエストからファイルを取得
    $file = $request->file('companies_csv_file');
    if ($file) {
        $fileName = $file->getClientOriginalName();
    }

    $searchString = '会員情報（会員企業管理画面）';
    // ファイル存在チェック
    if (!($request->hasFile('companies_csv_file')) || strpos($fileName, $searchString) === false) {
        $status = "会員企業登録用ファイルを選択してください";
        return view('kanri.admin.show_csv_upload', compact('user', 'status'));
    }

    $path = $file->getRealPath();
    $fp = fopen($path, 'r');
    fgetcsv($fp); // ヘッダー行をスキップ

    // 既存のメールアドレスを取得
    $existingEmails = DB::table('companies')->pluck('email')->toArray();
    $existingEmails2 = DB::table('companies')->pluck('email2')->toArray();
    $existingEmails3 = DB::table('companies')->pluck('email3')->toArray();

    $allDuplicateEmails = [];

    // トランザクション開始
    DB::beginTransaction();
    try {
        // 1行ずつ読み込み、企業テーブルに登録する
        while (($csvData = fgetcsv($fp)) !== FALSE) {
            $email = $csvData[2];
            $email2 = $csvData[3];
            $email3 = $csvData[4];

            $currentErrors = [];
            // メールアドレスの重複チェック
            if (!empty($email) && in_array($email, $existingEmails)) {
                $currentErrors[] = $email;
            }
            if (!empty($email2) && in_array($email2, $existingEmails2)) {
                $currentErrors[] = $email2;
            }
            if (!empty($email3) && in_array($email3, $existingEmails3)) {
                $currentErrors[] = $email3;
            }

            if (!empty($currentErrors)) {
                $allDuplicateEmails = array_merge($allDuplicateEmails, $currentErrors);
                continue;
            }

            // 企業データを挿入
            $this->AdminCsvImportService->InsertCompaniesCsvData($csvData);
        }

        // ファイルを閉じる
        fclose($fp);

        // エラーメッセージの表示
        if (!empty($allDuplicateEmails)) {
            // トランザクションをロールバック
            DB::rollBack();
            $uniqueDuplicateEmails = array_unique($allDuplicateEmails); // 重複メールを一意にする
            $status = "そのメールアドレスは既に存在しています: " . implode(', ', $uniqueDuplicateEmails);
        } else {
            // トランザクションをコミット
            DB::commit();
            $status = "会員企業登録用ファイルの取り込みが完了しました。";
        }
    } catch (\Exception $e) {
        // エラー発生時のロールバック
        DB::rollBack();
        fclose($fp);
        $status = "エラーが発生しました: " . $e->getMessage();
    }

    return view('kanri.admin.show_csv_upload', compact('user', 'status'));
}


    
    //企業情報、都道府県関連CSV登録
    public function importCompaniesdetailsCsv(Request $request)
    {
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        //セッションが切れた場合
        if (!$user) {
            return view('kanri.registration.loginCompany');
        }

        // リクエストからファイルを取得
        $file = $request->file('companiesdetails_csv_file');
        if($file){
            $fileName = $file->getClientOriginalName();
        }

        $searchString = '企業情報（企業情報管理）';
        //ファイル存在チェック
        if (!($request->hasFile('companiesdetails_csv_file')) || strpos($fileName, $searchString) === false) {
            $status = "企業情報用ファイルを選択してください";
            return view('kanri.admin.show_csv_upload', compact('user','status'));
        }
        

        // リクエストからファイルを取得
        $path = $file->getRealPath();
        $fp = fopen($path, 'r');
        fgetcsv($fp);
        //企業情報、都道府県関連CSV登録の場合1
        $result = $this->processCsv($fp,1);

        if ($result['status'] === 'error') {
            return view('kanri.admin.show_csv_upload', compact('user'))->with('status', $result['message']);
        }
        return view('kanri.admin.show_csv_upload', compact('user'))->with('status', $result['message']);

    }

    
    //防水情報CSV登録
    public function importWaterProofingCsv(Request $request)
    {

        $user = Session::get('user');
        $company_id = Session::get('company_id');

        //セッションが切れた場合
        if (!$user) {
            return view('kanri.registration.loginCompany');
        }

        // リクエストからファイルを取得
        $file = $request->file('WaterProofing_csv_file');
        if($file){
            $fileName = $file->getClientOriginalName();
        }

        $searchString = '防水工事情報（防水工事管理）';
        //ファイル存在チェック
        if (!($request->hasFile('WaterProofing_csv_file')) || strpos($fileName, $searchString) === false) {
            $status = "防水工事用ファイルを選択してください";
            return view('kanri.admin.show_csv_upload', compact('user','status'));
        }

        $path = $file->getRealPath();
        $fp = fopen($path, 'r');
        fgetcsv($fp);

        $result = $this->processCsv($fp,2);

        if ($result['status'] === 'error') {
            return view('kanri.admin.show_csv_upload', compact('user'))->with('status', $result['message']);
        }
        return view('kanri.admin.show_csv_upload', compact('user'))->with('status', $result['message']);

    }

    //求人情報CSV登録
    public function importJoboffersCsv(Request $request)
    {

        $user = Session::get('user');
        $company_id = Session::get('company_id');

        //セッションが切れた場合
        if (!$user) {
            return view('kanri.registration.loginCompany');
        }

        // リクエストからファイルを取得
        $file = $request->file('joboffers_csv_file');
        if($file){
            $fileName = $file->getClientOriginalName();
        }


        $searchString = '求人情報（求人情報管理）';
        //ファイル存在チェック
        if (!($request->hasFile('joboffers_csv_file')) || strpos($fileName, $searchString) === false) {
            $status = "求人情報用ファイルを選択してください";
            return view('kanri.admin.show_csv_upload', compact('user','status'));
        }

        $path = $file->getRealPath();
        $fp = fopen($path, 'r');
        fgetcsv($fp);

        $result = $this->processCsv($fp,3);

        if ($result['status'] === 'error') {
            return view('kanri.admin.show_csv_upload', compact('user'))->with('status', $result['message']);
        }
        return view('kanri.admin.show_csv_upload', compact('user'))->with('status', $result['message']);

    }

    //CSVチェック更新処理
    public function processCsv($fp, $g_id){
    // メールアドレス存在チェック(企業テーブルに存在する場合は取り込みエラーとする)
    DB::beginTransaction();
    try {
        while (($csvData = fgetcsv($fp)) !== FALSE) {
            $existingCompany = Company::where('email', $csvData[1])->first();
            if(!$existingCompany){
                //取り込みデータに対象のメールアドレスが存在しません。というメッセージを出す。
                $status = "取り込みデータに対象のメールアドレスが存在しないレコードがあります。";
                DB::rollBack();
                return ['status' => 'error', 'message' => $status];
            }

            $company_id = $existingCompany -> company_id;
            if($g_id == 1){
                $existingCompanyId = Companiesdetail::where('company_id', $company_id)->first();
            }elseif($g_id == 2){
                $existingCompanyId = Waterproof::where('company_id', $company_id)->first();
            }else{
                $existingCompanyId = Joboffer::where('company_id', $company_id)->first();
            }
            
            if($existingCompanyId){
                //取り込みデータに対象のメールアドレスが存在しません。というメッセージを出す。
                $status = "取り込みデータに既に登録されているメールアドレスが存在します。";
                DB::rollBack();
                return ['status' => 'error', 'message' => $status];
            }

            if($g_id == 1){
                $this->AdminCsvImportService->InsertCompaniesdetailCsvData($csvData,$company_id);
            }elseif($g_id == 2){
                $this->AdminCsvImportService->importWaterProofingCsv($csvData,$company_id);
            }else{
                $this->AdminCsvImportService->InsertJoboffersCsvData($csvData,$company_id);
            }
        }
        DB::commit();
    } catch (\Exception $e) {
        // 例外発生時にトランザクションをロールバック
        DB::rollBack();
        // エラーメッセージを設定してリダイレクト
        $status = "取り込み処理中にエラーが発生しました。";
        return ['status' => 'error', 'message' => $status];
    }

    fclose($fp);
    if($g_id == 1){
        return ['status' => 'success', 'message' => '企業情報用ファイルの取り込みが完了しました。'];
    }elseif($g_id == 2){
        return ['status' => 'success', 'message' => '防水工事用ファイルの取り込みが完了しました。'];
    }else{
        return ['status' => 'success', 'message' => '求人情報用ファイルの取り込みが完了しました。'];
    }

}

}
