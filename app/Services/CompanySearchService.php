<?php
namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Facades\DB;

class CompanySearchService
{
    public function fetchCompanyData($groupedPrefectures, $categories)
    {
        // 会社情報の取得
        $companies = Company::select(
            'companies.company_id',
            'companies.company_name',
            DB::raw("CONCAT('[', GROUP_CONCAT(wc.catName SEPARATOR ','), ']') AS catNames"),
            'w.waterproofing_job_image',
            'w.waterproofing_job_description',
            'w.waterproofing_job_catch',
            'cd.url',
            'cd.address_num',
            'cd.address',
            'cd.representative',
            'cd.phone',
            'cd.form',
        )
            ->leftJoin('companiesdetails as cd', 'cd.company_id', '=', 'companies.company_id')
            ->leftJoin('waterproofs as w', 'w.company_id', '=', 'companies.company_id')
            ->leftJoin('companiesdetails_prefectures as cp', 'cp.company_id', '=', 'companies.company_id')
            ->leftJoin('prefectures_cats as pc', 'pc.prefecuture_id', '=', 'cp.prefecuture_id')
            ->leftJoin('waterproof_waterproofdetails as ww', 'ww.waterproof_id', '=', 'w.company_id')
            ->leftJoin('waterproofdetails_cats as wc', 'wc.waterproofcat_id', '=', 'ww.waterproofcat_id')
            ->whereRaw('cp.prefecuture_id IN (' . $groupedPrefectures->flatMap(function ($region) {
                return $region['prefectures']->pluck('prefecture_id');
            })->implode(', ') . ')')
            ->whereRaw('wc.waterproofcat_id IN (' . implode(', ', $categories->keys()->toArray()) . ')')
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
                'cd.form',
            )
            ->paginate(10);

        return $companies;
    }
}
