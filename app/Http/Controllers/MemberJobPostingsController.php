<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Support\Facades\Session;
use App\Services\MemberJobPostingsService;
use Illuminate\Support\Facades\Storage;



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
        $company_id = Session::get('company_id');

        //求人情報を取得する
        $jobPostings = $this->MemberJobPostingsService->fetchCompanyData($company_id);

        //全求人カテゴリを取得する
        $JobofferdetailCatAll = $this->MemberJobPostingsService->fetchJobofferdetailCatsData();
        
        //ファイルのアップロード先を取得する
        $file_path = 'public/storage/';
        $jobPostingsImg = $jobPostings[0] -> prefecuture_image;
        $file_url = asset($file_path.$jobPostingsImg);
        dd($file_url);

        if ($user) {
            return view('kanri.member.member_job_postings', compact('user','jobPostings'));
        }

        return view('showCpmanyLoginForm');
    }

}