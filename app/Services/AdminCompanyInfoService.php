<?php
namespace App\Services;

use App\Models\Company;
use App\Models\Waterproof;
use App\Models\WaterproofWaterproofdetail;
use App\Models\Joboffer;
use App\Models\JoboffersJobofferdetail;
use App\Models\JobofferPrefecture;
use App\Models\Companieshistory;
use App\Models\CompaniesdetailsPrefecture;
use App\Models\Companiesdetail;
use App\Models\information;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendMail;

class AdminCompanyInfoService
{
    public function fetchCompanyDetailData()
    {
        // 会社情報の取得
        $companies = Company::select(
            'companies.company_id',
            'companies.company_name',
            'companies.company_name_kana',
            'companies.email',
            'companies.email2',
            'companies.email3',
            'companies.send_flg',
            'companies.updated_at',
        )
            ->leftJoin('companiesdetails as cd', 'cd.company_id', '=', 'companies.company_id')
            ->where('companies.user_type', 1)
            ->orderBy('companies.created_at' , 'desc')
            ->orderBy('companies.company_id' , 'desc')
            ->paginate(10);

        return $companies;
    }

    public function fetchInformationData($id)
    {
        // インフォメーション用会社情報の取得
        $informations = Information::select('information.id','information.information_id','information.updated_at', 'companies.company_name')
            ->selectRaw("CASE information.information_id
                            WHEN 1 THEN '会員企業管理'
                            WHEN 2 THEN 'お問い合わせ管理'
                            WHEN 3 THEN '求人情報管理'
                            ELSE 'その他の情報'
                          END AS information_name")
            ->leftJoin('companiesdetails', 'information.company_id', '=', 'companiesdetails.company_id')
            ->leftJoin('companies', 'companiesdetails.company_id', '=', 'companies.company_id')
            ->orderBy('information.id' ,'desc');
            
        // $idがnullでない場合は、information.id = $id
        if ($id !== null) {
            $informations->where('information.id', $id);
        }
        if ($id !== null) {
            $informations = $informations->get();
        }else{
            $informations = $informations->paginate(10);
        }
       
    
        return $informations;
    }

    //会員企業管理編集画面
    
    public function fetchCompanyInfoData($company_id)
    {

        // 会社情報の取得
        $companies = Company::select(
            'companies.company_id',
            'companies.company_name',
            'companies.company_name_kana',
            'companies.email',
            'companies.email2',
            'companies.email3',
        )
            ->where('companies.company_id', $company_id)
            ->get();

        return $companies;
    }

    //会員企業管理更新処理

    public function updateCompanyDetailData($updateEditAdminCompanyInfo)
    {

        // 会社情報の取得
        Company::where('company_id', $updateEditAdminCompanyInfo['company_id'])
        ->update([
            'company_name' => $updateEditAdminCompanyInfo['company_name'],
            'company_name_kana' => $updateEditAdminCompanyInfo['company_name_kana'],
            'email' => $updateEditAdminCompanyInfo['email'],
            'email2' => $updateEditAdminCompanyInfo['email2'],
            'email3' => $updateEditAdminCompanyInfo['email3'],
            'updated_at' => now(),
        ]);
    }

    //会員企業管理削除処理
    public function deleteCompanyDetailData($deleteEditAdminCompanyInfo)
    {
                // トランザクションを開始
    DB::beginTransaction();
    try {
        //防水関連情報の削除
        WaterproofWaterproofdetail::where('waterproof_id', $deleteEditAdminCompanyInfo['company_id']) ->delete();

        //防水情報の削除
        Waterproof::where('company_id', $deleteEditAdminCompanyInfo['company_id']) ->delete();

        //求人情報関連の削除
        JoboffersJobofferdetail::where('joboffer_id', $deleteEditAdminCompanyInfo['company_id']) ->delete();

        //防水都道府県情報の削除
        JobofferPrefecture::where('job_id', $deleteEditAdminCompanyInfo['company_id']) ->delete();

        //求人情報の削除
        Joboffer::where('company_id', $deleteEditAdminCompanyInfo['company_id']) ->delete();

        //防水情報の削除
        information::where('company_id', $deleteEditAdminCompanyInfo['company_id']) ->delete();

        //企業インフォメーションの削除
        Companieshistory::where('company_id', $deleteEditAdminCompanyInfo['company_id']) ->delete();

        //企業都道府県関連の削除
        CompaniesdetailsPrefecture::where('company_id', $deleteEditAdminCompanyInfo['company_id']) ->delete();

        //防水情報の削除
        Companiesdetail::where('company_id', $deleteEditAdminCompanyInfo['company_id']) ->delete();

        // 会社情報の削除
        Company::where('company_id', $deleteEditAdminCompanyInfo['company_id'])->delete();

        // コミット
        DB::commit();
    }catch (\Exception $e) {
            // エラーが発生した場合はロールバック
            DB::rollBack();
            throw $e; // 例外を再スローして呼び出し元でエラーを処理できるようにする
        }
    
    }

    //企業新規IDの取得
    public function fetchCompanyId()
    {
        // 会社情報の取得
        $createcompany_id = Company::max('company_id') + 1;
    
        return $createcompany_id;
    }

    //企業情報登録処理
    public function createCompanyInfo($createEditAdminCompanyAll)
    {
                        // トランザクションを開始
    DB::beginTransaction();
    try {
        //パスワードを生成する
        $newPassword = Str::random(10); // 10文字のランダムな文字列を生成する例
        //求人都道府県テーブルを登録する
        $Company = new Company();
        $Company -> company_id = $createEditAdminCompanyAll['createCompany_id'];
        $Company -> company_name = $createEditAdminCompanyAll['company_name'];
        $Company -> company_name_kana = $createEditAdminCompanyAll['company_name_kana'];
        $Company -> email = $createEditAdminCompanyAll['email'];
        $Company -> email2 = $createEditAdminCompanyAll['email2'];
        $Company -> email3 = $createEditAdminCompanyAll['email3'];
        $Company -> password = Hash::make($newPassword);
        $Company -> user_type = 1;
        $Company -> created_at = now();
        $Company -> updated_at = now();

        $Company->save();

        DB::commit();
    }catch (\Exception $e) {
        // エラーが発生した場合はロールバック
        DB::rollBack();
        throw $e; // 例外を再スローして呼び出し元でエラーを処理できるようにする
    }
    }

    //企業検索処理
    public function fetchInformationSearchResult($search_freeword)
    {
        // インフォメーション用会社情報の取得
        $informations = Information::select('information.id','information.information_id','information.updated_at', 'companies.company_name')
            ->selectRaw("CASE information.information_id
                            WHEN 1 THEN '会員企業管理'
                            WHEN 2 THEN 'お問い合わせ管理'
                            WHEN 3 THEN '求人情報管理'
                            ELSE 'その他の情報'
                          END AS information_name")
            ->leftJoin('companiesdetails', 'information.company_id', '=', 'companiesdetails.company_id')
            ->leftJoin('companies', 'companiesdetails.company_id', '=', 'companies.company_id')
            ->where('company_name', 'like',"%$search_freeword%")
            ->orderBy('information.id' ,'desc')
            ->paginate(10);
    
        return $informations;
    }

    public function fetchCompanyDetailSearchData($search_freeword)
    {
        // 会社情報の取得
        $companies = Company::select(
            'companies.company_id',
            'companies.company_name',
            'companies.company_name_kana',
            'companies.email',
            'companies.updated_at',
        )
            ->leftJoin('companiesdetails as cd', 'cd.company_id', '=', 'companies.company_id')
            ->where('companies.user_type', 1)
            ->where('company_name', 'like',"%$search_freeword%")
            ->orderBy('companies.company_id' , 'desc')
            ->orderby('cd.updated_at', 'desc')
            ->paginate(10);

        return $companies;
    }

    public function fetchCompanyDetailNotsendData()
    {
        // 会社情報の取得
        $companies = Company::select(
            'companies.company_id',
            'companies.company_name',
            'companies.company_name_kana',
            'companies.email',
            'companies.send_flg',
            'companies.updated_at',
        )
            ->leftJoin('companiesdetails as cd', 'cd.company_id', '=', 'companies.company_id')
            ->where('companies.user_type', 1)
            ->whereNull('companies.send_flg') // send_flg が NULL のレコードを取得
            ->orderBy('companies.updated_at', 'desc')
            ->orderBy('companies.company_id' , 'desc')
            ->paginate(10);

        return $companies;
    }

    

    
}