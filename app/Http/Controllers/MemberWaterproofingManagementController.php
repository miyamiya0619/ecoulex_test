<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberWaterproofingManagementService;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Support\Facades\Session;



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
        //ユーザIDから企業名を取得する
        $user = Session::get('user');


        if ($user) {
            //ログインユーザに紐づく企業詳細情報を取得する
            $company_id = $user -> company_id;

            // 会社情報の取得
            $worterProofs = $this->MemberWaterproofingManagementService->fetchCompanyData($company_id);


            return view('kanri.member.member_waterproofing_management_data', compact('worterProofs','user'));
        }

        return view('kanri.registration.loginCopmany');
    }

}
