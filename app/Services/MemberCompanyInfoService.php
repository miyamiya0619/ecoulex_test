<?php
namespace App\Services;

use App\Models\Company;
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
        )
            ->leftJoin('companiesdetails as cd', 'cd.company_id', '=', 'companies.company_id')
            ->leftJoin('companiesdetails_prefectures as cp', 'cp.company_id', '=', 'companies.company_id')
            ->leftJoin('prefectures_cats as pc', 'pc.prefecuture_id', '=', 'cp.prefecuture_id')
            ->where('companies.company_id', $company_id)
            ->get();

        return $companies;
    }
}
