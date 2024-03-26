<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Support\Facades\Session;
use App\Services\MemberWaterproofingManagementService;


class MemberWaterproofingManagementController extends Controller
{
    private $MemberWaterproofingManagementService;
    
    public function __construct(MemberWaterproofingManagementService $MemberWaterproofingManagementService)
    {
        $this->MemberWaterproofingManagementService = $MemberWaterproofingManagementService;
    }
    // お問い合わせトップ画面を表示
    public function index()
    {
        //ログインした後の情報を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        //ログインユーザに紐づく防水工事情報を取得する
        $worterProofs = $this->MemberWaterproofingManagementService->fetchCompanyData($company_id);
        //全工事カテゴリを取得する
        $worterProofCatAll = $this->MemberWaterproofingManagementService->fetchWaterProofingCatData();

        if ($user) {
            return view('kanri.member.member_waterproofing_management_data', compact('user','worterProofs','worterProofCatAll'));
        }

        return view('kanri.registration.loginCopmany');
    }

}
