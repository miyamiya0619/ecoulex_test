<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Support\Facades\Session;
use App\Services\MemberWaterproofingManagementService;


class EditMemberWaterproofingController extends Controller
{
    private $MemberWaterproofingManagementService;
    
    public function __construct(MemberWaterproofingManagementService $MemberWaterproofingManagementService)
    {
        $this->MemberWaterproofingManagementService = $MemberWaterproofingManagementService;
    }

    // お問い合わせトップ画面を表示
    public function index()
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        //ログインユーザに紐づく防水工事情報を取得する
        $worterProofs = $this->MemberWaterproofingManagementService->fetchCompanyData($company_id);
        //全工事カテゴリを取得する
        $worterProofCatAll = $this->MemberWaterproofingManagementService->fetchWaterProofingCatData();

        if ($user) {
            return view('kanri.member.edit_member_waterproofing', compact('user','worterProofs','worterProofCatAll'));
        }

        return view('showCpmanyLoginForm');
    }


    

}
