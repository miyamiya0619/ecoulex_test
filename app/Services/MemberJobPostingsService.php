<?php
namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Facades\DB;

class MemberJobPostingsService
{
    public function fetchCompanyData($company_id)
    {
        $companies = Company::select(
            'companies.company_id',
            'companies.company_name',
            DB::raw("GROUP_CONCAT(DISTINCT jc.catName SEPARATOR ',') AS catNames"),
            'jo.prefecuture_image',
            'jo.prefecuture_catch_head',
            'jo.prefecuture_catch_reading',
        )
         ->leftJoin('companiesdetails AS cd', 'cd.company_id', '=', 'companies.company_id')
        ->leftJoin('joboffers AS jo', 'jo.company_id', '=', 'companies.company_id')
        ->leftJoin('joboffers_jobofferdetails AS jj', 'jj.joboffer_id', '=', 'jo.id')
        ->leftJoin('jobofferdetail_cats AS jc', 'jc.jobcat_id', '=', 'jj.jobcat_id')
        ->where('companies.company_id', $company_id)
        ->groupBy(
            'companies.company_id',
            'companies.company_name',
            'jo.prefecuture_image',
            'jo.prefecuture_catch_head',
            'jo.prefecuture_catch_reading',
        )->get();

        return $companies;
    }
}
