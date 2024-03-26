<?php
namespace App\Services;

use App\Models\Company;
use App\Models\PrefecturesCat;
use App\Models\Companiesdetail;
use App\Models\CompaniesdetailsPrefecture;
use Illuminate\Support\Facades\DB;

class MemberCompanyInfoService
{
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


    }
    

}
