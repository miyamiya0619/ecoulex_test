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
            DB::raw("(SELECT CONCAT('[', GROUP_CONCAT(waterproofdetails_cats.catName SEPARATOR ','), ']')
                      FROM waterproofdetails_cats
                      INNER JOIN waterproof_waterproofdetails ON waterproofdetails_cats.waterproofcat_id = waterproof_waterproofdetails.waterproofcat_id
                      INNER JOIN waterproofs ON waterproofs.company_id = waterproof_waterproofdetails.waterproof_id
                      WHERE waterproofs.company_id = companies.company_id) AS catNames"),
            'w.waterproofing_job_image',
            'w.waterproofing_job_description',
            'w.waterproofing_job_catch',
            'cd.url',
            'cd.address_num',
            'cd.prefectureName',
            'cd.addressDetail',
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
        })->implode(', ') . ')');

        // $categories が null でない場合のみ、whereRaw を追加
        if ($categories !== null && $categories->isNotEmpty()) {
            $companies->whereRaw('wc.waterproofcat_id IN (' . implode(', ', $categories->keys()->toArray()) . ')');
        }

        $paginator = $companies->groupBy(
            'companies.company_id',
            'companies.company_name',
            'w.waterproofing_job_image',
            'w.waterproofing_job_description',
            'w.waterproofing_job_catch',
            'cd.url',
            'cd.address_num',
            'cd.prefectureName',
            'cd.addressDetail',
            'cd.representative',
            'cd.phone',
            'cd.form'
        )->paginate(10);

        return $paginator;
    }
}
