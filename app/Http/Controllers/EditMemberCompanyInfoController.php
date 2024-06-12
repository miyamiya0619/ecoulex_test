<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Support\Facades\Session;
use App\Services\MemberCompanyInfoService;


class EditMemberCompanyInfoController extends Controller
{

    private $MemberCompanyInfoService;

    public function __construct(MemberCompanyInfoService $MemberCompanyInfoService)
    {

    $this->MemberCompanyInfoService = $MemberCompanyInfoService;

    }

    // お問い合わせトップ画面を表示
    public function index()
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');
        // 会社情報を取得する
        $companies = $this->MemberCompanyInfoService->fetchCompanyDetailData($company_id);
        //全都道府県を取得する
        $prefectures = $this->MemberCompanyInfoService->fetchPrefecturesCatsData();

        if ($user) {
            
            return view('kanri.member.edit_member_company_info', compact('user','companies','prefectures'));
        }

        return view('kanri.registration.loginCompany');
    }

    public function updateCompanyInfo(Request $request)
    {
        //ユーザIDから企業名を取得する
        $user = Session::get('user');
        $company_id = Session::get('company_id');

        if ($user) {
        //パラメータの受け取り、不要な情報を削除
        $companiesdetailsAll = $request->all();

        //受け取ったパラメータで企業詳細情報を更新する
        $address_num = $companiesdetailsAll['address_num'];
        $prefectureId = $companiesdetailsAll['prefectureId'];
        $addressDetail = $companiesdetailsAll['addressDetail'];
        $representative = $companiesdetailsAll['representative'];



        // バリデーションルール
        $rules = [
            'url' => [
                'nullable',
                'url'  // URL形式チェック
            ],
            'address_num' => [
                'required',
                'regex:/^\d{3}-?\d{4}$/'
            ],
    
            'addressDetail' => [
                'required',
                'regex:/^[a-zA-Z0-9ａ-ｚＡ-Ｚ０-９ぁ-んァ-ヶ一-龥々ー\s\-]+$/u' // 所在地の形式チェック（許可される文字: 英数字、全角ひらがな、全角カタカナ、漢字、スペース、ハイフン）
            ],
    
            'number_of_employees' => [
                'nullable',
                'regex:/^[a-zA-Z0-9ａ-ｚＡ-Ｚ０-９ぁ-んァ-ヶ一-龥々ー\s\-\(\)（）]+$/u' // 社員数の形式チェック（許可される文字: 英数字、全角ひらがな、全角カタカナ、漢字、スペース、ハイフン）
            ],
    
            'year_of_establishment' => [
                'nullable',
                'regex:/^[a-zA-Z0-9ａ-ｚＡ-Ｚ０-９ぁ-んァ-ヶ一-龥々ー\s\-\(\)（）]+$/u' // 設立年の形式チェック（許可される文字: 英数字、全角ひらがな、全角カタカナ、漢字、スペース、ハイフン）
            ],
    
            'capital' => [
                'nullable',
                'regex:/^[a-zA-Z0-9ａ-ｚＡ-Ｚ０-９ぁ-んァ-ヶ一-龥々ー\s\-\(\)（）]+$/u' // 資本金の形式チェック（許可される文字: 英数字、全角ひらがな、全角カタカナ、漢字、スペース、ハイフン）
            ],
    
            'representative' => [
                'required',
                'regex:/^[a-zA-Z0-9ａ-ｚＡ-Ｚ０-９ぁ-んァ-ヶ一-龥々ー\s\-]+$/u' // 代表者の形式チェック（許可される文字: 英数字、全角ひらがな、全角カタカナ、漢字、スペース、ハイフン）
            ],
    
            'phone' => [
                'nullable',
                'regex:/^0\d{1,4}-\d{1,4}-\d{4}$/' // 電話番号の形式チェック
            ],
    
            'form' => [
                'nullable',
                'url'  // URL形式チェック
            ],
            
        ];


    // カスタムメッセージ
    $messages = [
        'url.url' => 'WEBサイトの形式が正しくありません',
        'address_num.required' => '郵便番号は必須です',
        'address_num.regex' => '郵便番号の形式が正しくありません',
        'addressDetail.required' => '所在地は必須です',
        'addressDetail.regex' => '所在地の形式が正しくありません',
        'number_of_employees.regex' => '社員数の形式が正しくありません',
        'year_of_establishment.regex' => '設立年の形式が正しくありません',
        'capital.regex' => '資本金の形式が正しくありません',
        'representative.required' => '代表者は必須です',
        'representative.regex' => '代表者の形式が正しくありません',
        'phone.regex' => '電話番号の形式が正しくありません',
        'form.url' => 'フォームの形式が正しくありません',
    ];
    // バリデーション実行
    $validator = validator()->make($companiesdetailsAll, $rules, $messages);

    if ($validator->fails()) {
        $status = $validator->errors()->first();
        return redirect()->route('ecoulex.kanri.editMemberCompanyInfo')->with('status', $status);
    }

        //必須項目が入力されている場合、実行
        if(!empty($address_num)&&!empty($prefectureId)&&!empty($addressDetail)&&!empty($representative)){

            $this->MemberCompanyInfoService->updateCompanyDetailData($company_id,$companiesdetailsAll);
            return redirect()->route('ecoulex.kanri.editMemberCompanyInfo')->with('status', '更新が完了しました');
        }else{
            return redirect()->route('ecoulex.kanri.editMemberCompanyInfo')->with('status', '必須項目をすべて入力してください');
        }
        
        }

        return view('kanri.registration.loginCompany');

    }
    
}
