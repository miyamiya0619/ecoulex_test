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

    //検索メイン処理(都道府県を押下した場合)
    public function recruit_search($prefecture_id,$region_id)
    {

        // validateRequest 関数を呼び出し、戻り値を取得する
        $prefectures = $this->RecruitService->getPrefectureData();
    
        // 会社情報の取得
        $companies = $this->RecruitSearchService->fetchCompanyData($prefecture_id,$region_id);
    
        //都道府県IDから都道府県名を取得する
        $prefecture_name = $this->RecruitSearchService->fetchPrefectureData($prefecture_id);

        //地域IDから地域名を取得する
        $region_name = $this->RecruitSearchService->fetchRegionData($region_id);

        // dd($region_name);
        

        return view('recruit.result', [
            'prefecture_id' => $prefecture_id,
            'region_id' => $region_id,
            'prefectures' => $prefectures,
            'companies' => $companies,
            'prefectures_sentence' => '選択してください',
            'prefecture_name' => $prefecture_name,
            'region_name' => $region_name[0]->regionName,
    ]);
    }

    //検索メイン処理(地域を押下した場合)
    public function recruit_search_region($region_id,$prefecture_id = 'all')
    {
        // validateRequest 関数を呼び出し、戻り値を取得する
        $prefectures = $this->RecruitService->getPrefectureData();
    
        // 会社情報の取得
        $companies = $this->RecruitSearchService->fetchCompanyData($prefecture_id,$region_id);
    
        //地域IDから地域名を取得する
        $region_name = $this->RecruitSearchService->fetchRegionData($region_id);

        // dd($region_name);

        return view('recruit.result', [
            'prefecture_id' => $prefecture_id,
            'region_id' => $region_id,
            'prefectures' => $prefectures,
            'companies' => $companies,
            'prefectures_sentence' => '選択してください',
            'prefecture_name' => '',
            'region_name' => $region_name[0]->regionName ,
    ]);
    }
    
    //検索メイン処理(採用情報一覧)
    // public function recruit_search_all($prefecture_id='all',$region_id=null)
    // {
    //     // validateRequest 関数を呼び出し、戻り値を取得する
    //     $prefectures = $this->RecruitService->getPrefectureData();
    
    //     // 会社情報の取得
    //     $companies = $this->RecruitSearchService->fetchCompanyData($prefecture_id,$region_id);
    
    //     return view('recruit.result', [
    //         'prefecture_id' => $prefecture_id,
    //         'region_id' => $region_id,
    //         'prefectures' => $prefectures,
    //         'companies' => $companies,
    //         'prefectures_sentence' => '選択してください',
    //         'prefecture_name' => '',
    // ]);
    // }

}
