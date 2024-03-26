<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Support\Facades\Session;
use App\Services\MemberJobPostingsService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;


class EditMemberJobPostingsController extends Controller
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
        //都道府県の情報を取得する
        $prefectures = $this->MemberJobPostingsService->fetchPrefecturesCatsData();

  

        if ($user) {
            return view('kanri.member.edit_member_job_postings', compact('user','jobPostings','JobofferdetailCatAll','prefectures'));
        }

        return view('kanri.registration.loginCompmany');
    }

    public function updateJobPostingInfo(Request $request)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');
        
        if ($user) {
            //パラメータの受け取る
            $jobPostingAll = $request->all();

            //パラメータの中に画像ファイルがあった場合、uploadsフォルダに画像を格納する
            if ($request->hasFile('prefecuture_image')) {
                //既存のファイルを削除する
                $filenameTodel = "/^jobPosting_{$company_id}_/";
                $files = Storage::disk('public')->files('images/uploads'); // ストレージディレクトリ内の全ファイルを取得
                foreach ($files as $file) {
                    if (preg_match($filenameTodel, basename($file))) {
                        Storage::delete($file); // ファイルを削除
                    }
                }
                //ファイルをアップロードする
                $prefecuture_image_up = $request->file('prefecuture_image');
                $datetime = Carbon::now()->format('YmdHisv');
                $filename = 'jobPosting_' . $company_id . '_' . $datetime . '.' . $prefecuture_image_up->getClientOriginalExtension();
                $prefecuture_image_up->storeAs('images/uploads', $filename);
            }else{
                $filename = "";
            }

            //ログイン情報に紐づく求人情報のレコードを取得する
            $jobPostingsRec = $this->MemberJobPostingsService->fetchJobPostingData($company_id);
            
            if($jobPostingsRec->count() == 0){
            //求人情報が存在しない場合は登録処理を行う
                $this->MemberJobPostingsService->insertJobPostingData($company_id,$jobPostingAll,$filename);
            }else{
            //求人情報が存在するばあいは更新処理を行う
                $this->MemberJobPostingsService->updateJobPostingData($company_id,$jobPostingAll,$filename);
            }
            
            return redirect()->route('ecoulex.kanri.updateJobPostingInfo');
        }
        return view('kanri.registration.loginCompmany');

    }

}
