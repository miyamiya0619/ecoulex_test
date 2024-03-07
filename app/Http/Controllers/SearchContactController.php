<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WaterproofdetailsCat;
use App\Models\PrefecturesCat;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class SearchContactController extends Controller
{
    //初期表示
    public function index()
    {
        // construction_cats全件取得
        $categories = WaterproofdetailsCat::all();
        // Prefecture全件取得
        $prefetures = PrefecturesCat::all(); 

        // 取得したデータをビューに渡して表示
        return view('contact.top01', compact('categories','prefetures'));
    }
    //検索メイン処理
    public function contact_search(Request $request)
    {
        //工事、カテゴリの必須チェック
        $errors = $this->validateRequest($request);
        
        // エラーメッセージがある場合はリダイレクト
        if (!empty($errors)) {
            return redirect()->back()->with('errors', $errors);
        }
    
        // カテゴリと都道府県情報の取得
        list($categories, $groupedPrefectures) = $this->fetchCategoryAndPrefectureData($request);
        
        //ページャ遷移時に使用するためセッションに保存
        session()->put('categories', $categories);
        session()->put('groupedPrefectures', $groupedPrefectures);
    
        // 会社情報の取得
        $companies = $this->fetchCompanyData();
        // dd($companies);
    
        return view('contact.result', compact('categories', 'groupedPrefectures', 'companies'));
    }

    public function contact_search_pagers(Request $request)
    {
        //セッションの取り出し
        $categories = session()->get('categories');
        $groupedPrefectures = session()->get('groupedPrefectures');
    
        // 会社情報の取得
        $companies = $this->fetchCompanyData();

    
        return view('contact.result', compact('categories', 'groupedPrefectures', 'companies'));
    }


    //検索実行時のバリデートチチェック
    private function validateRequest(Request $request)
    {
        // カテゴリと都道府県情報の必須チェック
        $categoryIds = $request->input('categories');
        $prefectureIds = $request->input('prefectures');
        $errors = [];

        if (empty($categoryIds)) {
            $errors[] = '工業は1つ以上選択してください';
        }

        if (empty($prefectureIds)) {
            $errors[] = '都道府県は1つ以上選択してください。';
        }

        return $errors;
    }


    //入力した情報の取得
    private function fetchCategoryAndPrefectureData(Request $request)
    {
        // カテゴリ情報の取得
        $categoryIds = $request->input('categories');
        $categories = WaterproofdetailsCat::whereIn('waterproofcat_id', $categoryIds)->pluck('catName', 'waterproofcat_id');
        
    
        // 都道府県情報の取得
        $prefectureIds = $request->input('prefectures');
        $prefectures = PrefecturesCat::whereIn('prefecuture_id', $prefectureIds)
            ->select('prefecuture_id', 'catName', 'region_id', 'regionName')
            ->get();
    
        // 都道府県情報を整形する
        $groupedPrefectures = collect($prefectures)->groupBy('region_id')->map(function ($regionPrefectures, $regionId) {
            $regionName = $regionPrefectures->first()['regionName'] ?? null;
            $prefecturesData = $regionPrefectures->map(function ($prefecture) {
                return [
                    'prefecture_id' => $prefecture['prefecuture_id'],
                    'prefecture_name' => $prefecture['catName'],
                ];
            });
    
            return [
                'region_id' => $regionId,
                'regionName' => $regionName,
                'prefectures' => $prefecturesData,
            ];
        })->values();
    
        return [$categories, $groupedPrefectures];
    }
    
    //企業情報の取り出し
    private function fetchCompanyData()
    {
        $groupedPrefectures = session()->get('groupedPrefectures');
        $categories = session()->get('categories');
        // dd($groupedPrefectures);
        


        // 会社情報の取得
        $companies = Company::select(
            'companies.company_id',
            'companies.company_name',
            DB::raw("CONCAT('[', GROUP_CONCAT(wc.catName SEPARATOR ','), ']') AS catNames"),
            'w.waterproofing_job_image',
            'w.waterproofing_job_description',
            'w.waterproofing_job_catch',
            'cd.url',
            'cd.address_num',
            'cd.address',
            'cd.representative',
            'cd.phone',
            'cd.form',
        )
        ->leftJoin('companiesdetails as cd', 'cd.company_id', '=', 'companies.company_id')
        ->leftJoin('waterproofs as w', 'w.company_id', '=', 'companies.company_id')
        ->leftJoin('companiesdetails_prefectures as cp', 'cp.company_id', '=', 'companies.company_id')
        ->leftJoin('prefectures_cats as pc', 'pc.prefecuture_id', '=', 'cp.prefecuture_id')
        ->leftJoin('waterproof_waterproofdetails as ww', 'ww.waterproof_id', '=', 'w.company_id')
        ->leftJoin('waterproofdetails_cats as wc', 'wc.waterproofcat_id', '=', 'ww.waterproofcat_id')
        ->whereRaw('cp.prefecuture_id IN (' . $groupedPrefectures->flatMap(function ($region) {
            return $region['prefectures']->pluck('prefecture_id');
        })->implode(', ') . ')')        
        ->whereRaw('wc.waterproofcat_id IN (' . implode(', ', $categories->keys()->toArray()) . ')')
        ->groupBy(
            'companies.company_id',
            'companies.company_name',
            'w.waterproofing_job_image',
            'w.waterproofing_job_description',
            'w.waterproofing_job_catch',
            'cd.url',
            'cd.address_num',
            'cd.address',
            'cd.representative',
            'cd.phone',
            'cd.form',
        )
        ->paginate(10);
    
    
        return $companies;
    }

}

