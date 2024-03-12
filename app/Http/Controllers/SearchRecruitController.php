<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RecruitService;
use App\Services\RecruitSearchService;

class SearchRecruitController extends Controller
{

    private $RecruitService;
    private $RecruitSearchService;
    
    public function __construct(RecruitSearchService $recruitSearchService, RecruitService $recruitService)
    {
        $this->RecruitSearchService = $recruitSearchService;
        $this->RecruitService = $recruitService;
    }

    //初期表示
    public function index()
    {
        return view('recruit.top');
    }

    //検索メイン処理
    public function recruit_search($prefecture_id)
    {

        // validateRequest 関数を呼び出し、戻り値を取得する
        $prefectures = $this->RecruitService->getPrefectureData();
    
        // 会社情報の取得
        $companies = $this->RecruitSearchService->fetchCompanyData($prefecture_id);

        
    
        return view('recruit.result', [
            'prefecture_id' => $prefecture_id,
            'prefectures' => $prefectures,
            'companies' => $companies,
    ]);
    }

}
