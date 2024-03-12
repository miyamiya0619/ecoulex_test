<?php
namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Facades\DB;

class RecruitSearchService
{
    public function fetchCompanyData($prefecture_id)
    {
        // 会社情報の取得
        $companies = Company::select(
            'companies.company_id',
            'companies.company_name',
            DB::raw("GROUP_CONCAT(DISTINCT jc.catName SEPARATOR ',') AS catNames"),
            'w.waterproofing_job_image',
            'w.waterproofing_job_description',
            'w.waterproofing_job_catch',
            'cd.url',
            'cd.address_num',
            'cd.address',
            'cd.representative',
            'cd.phone',
            'cd.form'
            )
            ->leftJoin('companiesdetails as cd', 'cd.company_id', '=', 'companies.company_id')
            ->leftJoin('waterproofs as w', 'w.company_id', '=', 'companies.company_id')
            ->leftJoin('companiesdetails_prefectures as cp', 'cp.company_id', '=', 'companies.company_id')
            ->leftJoin('prefectures_cats as pc', 'pc.prefecuture_id', '=', 'cp.prefecuture_id')
            ->leftJoin('waterproof_waterproofdetails as ww', 'ww.waterproof_id', '=', 'w.company_id')
            ->leftJoin('waterproofdetails_cats as wc', 'wc.waterproofcat_id', '=', 'ww.waterproofcat_id')
            ->leftJoin('joboffers as jo', 'jo.company_id', '=', 'companies.company_id')
            ->leftJoin('joboffers_jobofferdetails as jj', 'jj.joboffer_id', '=', 'jo.id')
            ->leftJoin('jobofferdetail_cats as jc', 'jc.jobcat_id', '=', 'jj.jobcat_id')
            ->where('cp.prefecuture_id', '=', $prefecture_id)
            ->groupBy(
                'companies.company_id',
                'companies.company_name',
                'w.waterproofing_job_image',
                'w.waterproofing_job_description',
                'w.waterproofing_job_catch',
                'cd.url',
                'cd.address_num',
                'cd.address',
                'cd.representative',
                'cd.phone',
                'cd.form'
            )
            ->get();

        return $companies;
    }
}
