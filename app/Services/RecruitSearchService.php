<?php
namespace App\Services;

use App\Models\Company;
use App\Models\PrefecturesCat;
use Illuminate\Support\Facades\DB;

class RecruitSearchService
{
    public function fetchCompanyData($prefecture_id,$region_id)
    {
        // 会社情報の取得
        $companies = Company::select(
            'companies.company_id',
            'companies.company_name',
            DB::raw("GROUP_CONCAT(DISTINCT jc.catName SEPARATOR ',') AS catNames"),
            'jo.prefecuture_image',
            'jo.prefecuture_catch_head',
            'jo.prefecuture_catch_reading',
            'jo.locate',
            'jo.working_hours',
            'jo.monthly_income',
            'cd.url',
            'cd.address_num',
            'cd.address',
            'cd.number_of_employees',
            'cd.year_of_establishment',
            'cd.capital',
            'cd.representative',
            'cd.phone',
            'cd.form'
        )
         ->leftJoin('companiesdetails AS cd', 'cd.company_id', '=', 'companies.company_id')
        ->leftJoin('companiesdetails_prefectures AS cp', 'cp.company_id', '=', 'companies.company_id')
        ->leftJoin('prefectures_cats AS pc', 'pc.prefecuture_id', '=', 'cp.prefecuture_id')
        ->leftJoin('joboffers AS jo', 'jo.company_id', '=', 'companies.company_id')
        ->leftJoin('joboffers_jobofferdetails AS jj', 'jj.joboffer_id', '=', 'jo.id')
        ->leftJoin('jobofferdetail_cats AS jc', 'jc.jobcat_id', '=', 'jj.jobcat_id')
        ->groupBy(
            'companies.company_id',
            'companies.company_name',
            'jo.prefecuture_image',
            'jo.prefecuture_catch_head',
            'jo.prefecuture_catch_reading',
            'jo.locate',
            'jo.working_hours',
            'jo.monthly_income',
            'cd.url',
            'cd.address_num',
            'cd.address',
            'cd.number_of_employees',
            'cd.year_of_establishment',
            'cd.capital',
            'cd.representative',
            'cd.phone',
            'cd.form'
        );

        //地域を押下した場合
        if ($region_id !== null) {
            $companies->addSelect('pc.region_id')
            ->groupBy('pc.region_id')
            ->where('pc.region_id', '=', $region_id);
        }
        // 採用情報一覧を見るボタンを押下した場合
        if ($prefecture_id !== 'all') {
            $companies->where('cp.prefecuture_id', '=', $prefecture_id);
        }
        return $companies->get();
    }

    //都道府県IDから都道府県名を取得する
    public function fetchPrefectureData($prefecture_id){

        $prefecture_name = PrefecturesCat::select(
            'prefectures_cats.catName'
        )->where('prefectures_cats.prefecuture_id', '=', $prefecture_id);

        return $prefecture_name->get();
    }
}
