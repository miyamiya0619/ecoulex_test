<?php
namespace App\Services;

use App\Models\Company;
use App\Models\PrefecturesCat;
use App\Models\Companiesdetail;
use App\Models\CompaniesdetailsPrefecture;
use Illuminate\Support\Facades\DB;

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
        )
            ->leftJoin('companiesdetails as cd', 'cd.company_id', '=', 'companies.company_id')
            ->paginate(10);

        return $companies;
    }

}
