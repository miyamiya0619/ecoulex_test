<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberJobPostingsService;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Support\Facades\Session;



class MemberJobPostingsController extends Controller
{
    private $MemberJobPostingsService;
    
    public function __construct(MemberJobPostingsService $MemberJobPostingsService)
    {
        $this->MemberJobPostingsService = $MemberJobPostingsService;
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
            $companies = $this->MemberJobPostingsService->fetchCompanyData($company_id);
            return view('kanri.member.member_job_postings', compact('companies','user'));
        }

        return view('showCpmanyLoginForm');
    }

}