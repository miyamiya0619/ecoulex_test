<?php
namespace App\Services;

use App\Models\Company;
use App\Models\PrefecturesCat;
use App\Models\Companiesdetail;
use App\Models\CompaniesdetailsPrefecture;
use App\Models\information;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminCompanyMailListService
{

    public function fetchCompanyMailList($id, $m_id)
    {
        $columns = [
            1 => 'email',
            2 => 'email2',
            3 => 'email3',
        ];
    
        $column = $columns[$m_id] ?? 'email';  // デフォルトで'email'を使用
    
        $mailList = Company::select('company_id','company_name',"{$column} as email")
            ->where('company_id', $id)
            ->get();
    
        return $mailList;
    }

    //カラムを変更する処理
    public function updateCompanyMailList($id, $m_id, $mail)
    {
        $columns = [
            1 => 'email',
            2 => 'email2',
            3 => 'email3',
        ];
        $column = $columns[$m_id] ?? 'email';  // デフォルトで'email'を使用
        
        Company::where('company_id', $id)
        ->update([
            "{$column}" => $mail,
        ]);
    }

    //カラムの中身を削除する処理
    public function deleteCompanyMailList($id, $m_id)
    {
        $columns = [
            1 => 'email',
            2 => 'email2',
            3 => 'email3',
        ];
        $column = $columns[$m_id] ?? 'email';  // デフォルトで'email'を使用
        
        Company::where('company_id', $id)
        ->update([
            "{$column}" => "",
        ]);
    }


}