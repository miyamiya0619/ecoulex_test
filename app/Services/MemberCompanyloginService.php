<?php
namespace App\Services;

use App\Models\Companieshistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class MemberCompanyloginService
{
    public function CreateCompanieshistoryData($company_id)
    {
        // 会社情報の取得
        Companieshistory::create([
            'company_id' => $company_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    public function fetchCompanieshistoryCntData($company_id)
    {
        // 会社ログイン情報の取得
        $loginCnt = Companieshistory::where('company_id', $company_id)->count();

        return $loginCnt;
    }
        //3件以上ログイン履歴がある場合、最も古いレコードを削除
    public function DeleteCompanieshistoryData($company_id,$loginCnt)
    {
        $oldestRecords = CompaniesHistory::where('company_id', $company_id)
        ->orderBy('created_at')
        ->limit($loginCnt - 3)
        ->get();
    
            foreach ($oldestRecords as $record) 
            {
                $record->delete();
            }
    }

    //3件以上ログイン履歴がある場合、最も古いレコードを削除
    public function fetchCompanieshistoryLoginTData($company_id)
    {
        $companyLoginT = Companieshistory::where('company_id', $company_id)
                                          ->orderBy('id', 'desc')
                                          ->select('created_at')
                                          ->get();
        return $companyLoginT;
    }

}
