<?php
namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Facades\DB;

class MemberWaterproofingManagementService
{
    public function fetchCompanyData($company_id)
    {
        // 会社情報の取得
        $worterProofs = Company::select(
            'companies.company_id',
            'companies.company_name',
            DB::raw("CONCAT('[', GROUP_CONCAT(wc.catName SEPARATOR ','), ']') AS catNames"),
            'w.waterproofing_job_description',
            'w.waterproofing_job_catch',
            'w.waterproofing_job_image',
        )
            ->leftJoin('companiesdetails as cd', 'cd.company_id', '=', 'companies.company_id')
            ->leftJoin('waterproofs as w', 'w.company_id', '=', 'companies.company_id')
            ->leftJoin('waterproof_waterproofdetails as ww', 'ww.waterproof_id', '=', 'w.company_id')
            ->leftJoin('waterproofdetails_cats as wc', 'wc.waterproofcat_id', '=', 'ww.waterproofcat_id')
            ->where('companies.company_id', $company_id)
            ->groupBy(
                'companies.company_id',
                'companies.company_name',
                'w.waterproofing_job_image',
                'w.waterproofing_job_description',
                'w.waterproofing_job_catch',
            )
            ->get();

        return $worterProofs;
    }
}
