<?php
namespace App\Services;

use App\Models\Company;
use App\Models\PrefecturesCat;
use App\Models\Companiesdetail;
use App\Models\CompaniesdetailsPrefecture;
use App\Models\information;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminCompanyDetailInfoService
{

    //会員企業管理一覧画面
    public function fetchCompanyDetailDataAll()
    {
        // 会社情報の取得
        $companies = Company::select(
            'companies.company_id',
            'companies.company_name',
            'companies.company_name_kana',
            'companies.email',
            'cd.url',
            'cd.address_num',
            'cd.prefectureName',
            'cd.addressDetail',
            'cd.number_of_employees',
            'cd.year_of_establishment',
            'cd.capital',
            'cd.representative',
            'cd.phone',
            'cd.form',
            'cp.prefecuture_id',
            'cd.updated_at',
        )
            ->leftJoin('companiesdetails as cd', 'cd.company_id', '=', 'companies.company_id')
            ->leftJoin('companiesdetails_prefectures as cp', 'cp.company_id', '=', 'companies.company_id')
            ->leftJoin('prefectures_cats as pc', 'pc.prefecuture_id', '=', 'cp.prefecuture_id')
            ->where('companies.user_type', 1)
            ->orderby('cd.updated_at', 'desc')
            ->paginate(10);
        return $companies;
    }

    public function fetchCompanyDetailData($company_id)
    {
        // 会社情報の取得
        $companies = Company::select(
            'companies.company_id',
            'companies.company_name',
            'companies.company_name_kana',
            'companies.email',
            'cd.url',
            'cd.address_num',
            'cd.prefectureName',
            'cd.addressDetail',
            'cd.number_of_employees',
            'cd.year_of_establishment',
            'cd.capital',
            'cd.representative',
            'cd.phone',
            'cd.form',
            'cp.prefecuture_id',
        )
            ->leftJoin('companiesdetails as cd', 'cd.company_id', '=', 'companies.company_id')
            ->leftJoin('companiesdetails_prefectures as cp', 'cp.company_id', '=', 'companies.company_id')
            ->leftJoin('prefectures_cats as pc', 'pc.prefecuture_id', '=', 'cp.prefecuture_id')
            ->where('companies.company_id', $company_id)
            ->get();

        return $companies;
    }

    //カテゴリを全件取得
    public function fetchPrefecturesCatsData()
    {
        $PrefecturesCats = PrefecturesCat::all();
        return $PrefecturesCats;
    }

    public function updateCompanyDetailData($company_id,$companiesdetailsAll)
    {

        //prefectureIdからprefectureNameを取得する
        $prefectureName = PrefecturesCat::select('catName')->where('prefecuture_id', $companiesdetailsAll['prefectureId'])->get();

        //企業詳細テーブルからログイン対象のレコードを取得する
        $judgeCompaniedDetailExist = Companiesdetail::where('company_id', $company_id)->get();

        //存在していない場合、企業情報テーブルを更新する
        if($judgeCompaniedDetailExist->count() == 0){

        $company = new Companiesdetail();
        $company->company_id = $company_id;
        $company->url = $companiesdetailsAll['url'];
        $company->address_num = $companiesdetailsAll['address_num'];
        $company->prefectureName = $prefectureName[0]->catName;
        $company->addressDetail = $companiesdetailsAll['addressDetail'];
        $company->number_of_employees = $companiesdetailsAll['number_of_employees'];
        $company->year_of_establishment = $companiesdetailsAll['year_of_establishment'];
        $company->capital = $companiesdetailsAll['capital'];
        $company->representative = $companiesdetailsAll['representative'];
        $company->phone = $companiesdetailsAll['phone'];
        $company->form = $companiesdetailsAll['form'];
        $company->save();

        //企業都道府県関連テーブルに挿入する
        $CompaniesdetailsPrefecture = new CompaniesdetailsPrefecture();
        $CompaniesdetailsPrefecture->company_id = $company_id;
        $CompaniesdetailsPrefecture->prefecuture_id = $companiesdetailsAll['prefectureId'];
        $CompaniesdetailsPrefecture->save();

        }else{
        //企業詳細テーブルを更新する
        Companiesdetail::where('company_id', $company_id)
        ->update([
            'url' => $companiesdetailsAll['url'],
            'address_num' => $companiesdetailsAll['address_num'],
            'prefectureName' => $prefectureName[0]->catName,
            'addressDetail' => $companiesdetailsAll['addressDetail'],
            'number_of_employees' => $companiesdetailsAll['number_of_employees'],
            'year_of_establishment' => $companiesdetailsAll['year_of_establishment'],
            'capital' => $companiesdetailsAll['capital'],
            'representative' => $companiesdetailsAll['representative'],
            'phone' => $companiesdetailsAll['phone'],
            'form' => $companiesdetailsAll['form']
        ]);

        //企業都道府県関連テーブルを更新する
        CompaniesdetailsPrefecture::where('company_id', $company_id)->update(['prefecuture_id' => $companiesdetailsAll['prefectureId']]);



        }
        //インフォメーションテーブルに格納し、事務局側に反映
        information::insert([
            'company_id' => $company_id,
            'information_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }

    //会員企業管理削除処理
    public function deleteCompanyDetailData($deleteEditAdminCompanyInfo)
    {
                // トランザクションを開始
    DB::beginTransaction();
    try {

        //企業都道府県関連の削除
        CompaniesdetailsPrefecture::where('company_id', $deleteEditAdminCompanyInfo['company_id']) -> delete();
        //防水情報の削除
        information::where('company_id', $deleteEditAdminCompanyInfo['company_id']) ->delete();
        //防水情報の削除
        Companiesdetail::where('company_id', $deleteEditAdminCompanyInfo['company_id']) -> delete();

        // コミット
        DB::commit();
    }catch (\Exception $e) {
            // エラーが発生した場合はロールバック
            DB::rollBack();
            throw $e; // 例外を再スローして呼び出し元でエラーを処理できるようにする
        }
    
    }


    //会員企業管理一覧画面
    public function fetchCompanyDetailSearchData($search_freeword)
    {
        // 会社情報の取得
        $companies = Company::select(
            'companies.company_id',
            'companies.company_name',
            'companies.company_name_kana',
            'companies.email',
            'cd.url',
            'cd.address_num',
            'cd.prefectureName',
            'cd.addressDetail',
            'cd.number_of_employees',
            'cd.year_of_establishment',
            'cd.capital',
            'cd.representative',
            'cd.phone',
            'cd.form',
            'cp.prefecuture_id',
            'cd.updated_at',
        )
            ->leftJoin('companiesdetails as cd', 'cd.company_id', '=', 'companies.company_id')
            ->leftJoin('companiesdetails_prefectures as cp', 'cp.company_id', '=', 'companies.company_id')
            ->leftJoin('prefectures_cats as pc', 'pc.prefecuture_id', '=', 'cp.prefecuture_id')
            ->where('companies.user_type', 1)
            ->where('companies.company_name', 'like',"%$search_freeword%")
            ->orderby('cd.updated_at', 'desc')
            ->paginate(10);
        return $companies;
    }





}