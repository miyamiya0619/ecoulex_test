<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Services\CompanySearchService;
use App\Services\ContactService;

class SearchContactController extends Controller
{
    private $companySearchService;
    private $ContactService;
    
    public function __construct(CompanySearchService $companySearchService, ContactService $ContactService)
    {
        $this->companySearchService = $companySearchService;
        $this->ContactService = $ContactService;
    }
    

    //初期表示
    public function index()
    {
        $data = $this->ContactService->getIndexData();

        
        if (session()->has('categoryIds') || session()->has('prefectureIds') || !empty($_GET['checkflg'])) {
            $categoryIds = session()->get('categoryIds');
            $prefectureIds = session()->get('prefectureIds');

            // セッションから特定のキーを破棄
            session()->forget('categoryIds');
            session()->forget('prefectureIds');
        } else {
            // セッションからデータが取得できない場合は初期化
            $categoryIds = [];
            $prefectureIds = [];
        }

        $data['categoryIds'] = $categoryIds;
        $data['prefectureIds'] = $prefectureIds;

        // dd($data);

        // 取得したデータをビューに渡して表示
        return view('contact.top01', $data);
    }

    //検索メイン処理
    public function contact_search(Request $request)
    {
        // validateRequest 関数を呼び出し、戻り値を取得する
        $result = $this->validateRequest($request);

        // エラーメッセージを取得
        $errors = $result['errors'];

        // カテゴリIDを取得
        $categoryIds = $result['categoryIds'];

        // 都道府県IDを取得
        $prefectureIds = $result['prefectureIds'];

            
        session()->put('categoryIds', $categoryIds);
        session()->put('prefectureIds', $prefectureIds);

        // エラーメッセージがある場合はリダイレクト
        if (!empty($errors)) {

            return redirect()->action([SearchContactController::class, 'index'])->withErrors($errors)->withInput([
                'categoryIds' => $categoryIds,
                'prefectureIds' => $prefectureIds
            ]);
        }
    
        // カテゴリと都道府県情報の取得
        list($categories, $groupedPrefectures) = $this->ContactService->getCategoryAndPrefectureData($categoryIds, $prefectureIds);
        
        //ページャ遷移時に使用するためセッションに保存
        session()->put('categories', $categories);
        session()->put('groupedPrefectures', $groupedPrefectures);
    
        // 会社情報の取得
        $companies = $this->companySearchService->fetchCompanyData($groupedPrefectures, $categories);
    
        return view('contact.result', compact('categories', 'groupedPrefectures', 'companies'));
    }

    public function contact_search_pagers(Request $request)
    {
        //セッションの取り出し
        $categories = session()->get('categories');
        $groupedPrefectures = session()->get('groupedPrefectures');
    
        // 会社情報の取得
        $companies = $this->companySearchService->fetchCompanyData($groupedPrefectures, $categories);

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


        // 連想配列として$errors、$categoryIds、$prefectureIdsを返す
        return [
            'errors' => $errors,
            'categoryIds' => $categoryIds,
            'prefectureIds' => $prefectureIds,
        ];
    }


}

