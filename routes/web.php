<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchContactController;
use App\Http\Controllers\SearchRecruitController;
use App\Http\Controllers\Auth\CompanyLoginController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\MemberCompanyInfoController;
use App\Http\Controllers\MemberWaterproofingManagementController;
use App\Http\Controllers\MemberJobPostingsController;
use App\Http\Controllers\EditMemberCompanyInfoController;
use App\Http\Controllers\EditMemberWaterproofingController;
use App\Http\Controllers\EditMemberJobPostingsController;
use App\Http\Controllers\CompanyPasswordForgetController;
use App\Http\Controllers\AdminCompanyInfoController;
use App\Http\Controllers\ShowAdminCompanyInfoController;
use App\Http\Controllers\EditAdminCompanyInfoController;
use App\Http\Controllers\AdminCompanyDetailInfoController;
use App\Http\Controllers\AdminjobPostingInfoController;
use App\Http\Controllers\EditAdminjobPostingInfoController;
use App\Http\Controllers\AdminWaterProofInfoController;
use App\Http\Controllers\EditAdminWaterProofInfoController;
use App\Http\Controllers\EditAdminCompanyDetailInfoController;
use App\Http\Controllers\CsvUploadController;
use App\Http\Controllers\AdminCompanyMailListController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// サイトトップ
Route::get('/lp/mirai_project/', function () {
    return view('top');
});

// challenger
Route::get('/lp/mirai_project/challenger/', function () {
    return view('challenger/top');
});

//ヘッダーCONTACT→防水工事・各種工事のご相談
//contact(4/12では関東のみのリリース)

// Route::get('/lp/mirai_project/contact/', function () {
//     return view('contact/top');
// });

Route::get('/lp/mirai_project/contact/', [SearchContactController::class, 'index'])->name('index');
Route::post('/lp/mirai_project/contact/', [SearchContactController::class, 'index'])->name('index');


//contact(5月では全域のリリース)
// Route::get('/lp/mirai_project/contact/', function () {
//     return view('contact/top01');
// });

//防水工事・各種工事のご相談の検索処理
//contact(4/12では関東のみのリリース)

Route::post('/lp/mirai_project/contact/result/', [SearchContactController::class, 'contact_search'])->name('contact_search');
Route::get('/lp/mirai_project/contact/result', [SearchContactController::class, 'contact_search_pagers'])->name('contact_search_pagers');

//future
Route::get('/lp/mirai_project/future/', function () {
    return view('future/top');
});

//lab
Route::get('/lp/mirai_project/lab/', function () {
    return view('lab/top');
});

//message
Route::get('/lp/mirai_project/message/', function () {
    return view('message/top');
});

//recruit
Route::get('/lp/mirai_project/recruit/', [SearchRecruitController::class, 'index'])->name('index');
Route::get('/lp/mirai_project/recruit/result/prefecture/{prefecture_id}/region/{region_id}', [SearchRecruitController::class, 'recruit_search'])->name('recruit_search');


Route::get('/lp/mirai_project/recruit/result', [SearchRecruitController::class, 'recruit_search_all'])->name('recruit_search_all');
Route::get('/lp/mirai_project/recruit/result/region/{region_id}', [SearchRecruitController::class, 'recruit_search_region'])->name('recruit_search_region');

// 管理画面（企業側）

// ログイン
Route::get('/lp/mirai_project/kanri/loginCompany/', [CompanyLoginController::class, 'showCpmanyLoginForm'])->name('showCpmanyLoginForm');
Route::post('/lp/mirai_project/kanri/loginCompany/', [CompanyLoginController::class, 'login'])->name('login');

//お問い合わせ管理（トップページ）
Route::get('/lp/mirai_project/kanri/memberDashboard', [TopController::class, 'index'])->name('ecoulex.kanri.memberDashboard');

//お問い合わせ管理（企業情報管理ページ）
Route::get('/lp/mirai_project/kanri/memberCompanyInfo', [MemberCompanyInfoController::class, 'index'])->name('ecoulex.kanri.memberCompanyInfo');
Route::get('/lp/mirai_project/kanri/editMemberCompanyInfo', [EditMemberCompanyInfoController::class, 'index'])->name('ecoulex.kanri.editMemberCompanyInfo');
Route::post('/lp/mirai_project/kanri/editMemberCompanyInfo', [EditMemberCompanyInfoController::class, 'updateCompanyInfo'])->name('ecoulex.kanri.editMemberCompanyInfo.updateCompanyInfo');

//お問い合わせ管理（防水工事管理ページ）
Route::get('/lp/mirai_project/kanri/memberWaterproofingManagement', [MemberWaterproofingManagementController::class, 'index'])->name('ecoulex.kanri.memberWaterproofingManagement');
Route::get('/lp/mirai_project/kanri/editMemberWaterproofing', [EditMemberWaterproofingController::class, 'index'])->name('ecoulex.kanri.editMemberWaterproofing');
Route::post('/lp/mirai_project/kanri/editMemberWaterproofing', [EditMemberWaterproofingController::class, 'updateWaterProofingInfo'])->name('ecoulex.kanri.editMemberWaterproofing');

//お問い合わせ管理（求人情報管理ページ）
Route::get('/lp/mirai_project/kanri/memberJobPostings', [MemberJobPostingsController::class, 'index'])->name('ecoulex.kanri.memberJobPostings');
Route::get('/lp/mirai_project/kanri/editMemberJobPostings', [EditMemberJobPostingsController::class, 'index'])->name('ecoulex.kanri.editMemberJobPostings');
Route::post('/lp/mirai_project/kanri/editMemberJobPostings', [EditMemberJobPostingsController::class, 'updateJobPostingInfo'])->name('ecoulex.kanri.updateJobPostingInfo');

//パスワード忘れ
Route::get('/lp/mirai_project/kanri/forgot_password', [CompanyPasswordForgetController::class, 'index'])->name('ecoulex.kanri.forgot_password');
Route::post('/lp/mirai_project/kanri/forgot_password_complete', [CompanyPasswordForgetController::class, 'forgot_password_complete'])->name('ecoulex.kanri.forgot_password_complete');

// 管理画面（事務局側）
//トップ
Route::get('/lp/mirai_project/kanri/adminDashboard', [TopController::class, 'index'])->name('ecoulex.kanri.adminDashboard');
Route::get('/lp/mirai_project/kanri/showAdminDashboard/id/{id}', [ShowAdminCompanyInfoController::class, 'showInformation'])->name('ecoulex.kanri.showAdminDashboard');
//トップ検索
Route::post('/lp/mirai_project/kanri/adminDashboard', [TopController::class, 'dashboardSearch'])->name('ecoulex.kanri.dashboardSearch');


//メールアドレス一覧
Route::get('/lp/mirai_project/kanri/listmailaddress', [AdminCompanyMailListController::class, 'index'])->name('ecoulex.kanri.listmailaddress');

//メールアドレス一覧検索
Route::post('/lp/mirai_project/kanri/listmailaddress', [AdminCompanyMailListController::class, 'mailListSearch'])->name('ecoulex.kanri.mailListSearch');

Route::get('/lp/mirai_project/kanri/editlistmailaddressdetail/id/{company_id}/m_id/{m_id}', [AdminCompanyMailListController::class, 'editmailList'])->name('ecoulex.kanri.editlistmailaddressdetail');
Route::get('/lp/mirai_project/kanri/editlistmailaddressdetail/complete', [AdminCompanyMailListController::class, 'updateEditmailList'])->name('ecoulex.kanri.updateEditlistmailaddressdetail');
Route::post('/lp/mirai_project/kanri/editlistmailaddressdetail/complete', [AdminCompanyMailListController::class, 'updateEditmailList'])->name('ecoulex.kanri.updateEditlistmailaddressdetail');


Route::get('/lp/mirai_project/kanri/dellistmailaddressdetail/id/{company_id}/m_id/{m_id}', [AdminCompanyMailListController::class, 'delmailList'])->name('ecoulex.kanri.dellistmailaddressdetail');
Route::get('/lp/mirai_project/kanri/dellistmailaddressdetail/complete', [AdminCompanyMailListController::class, 'deleteEditmailList'])->name('ecoulex.kanri.deleteEditlistmailaddressdetail');
Route::post('/lp/mirai_project/kanri/dellistmailaddressdetail/complete', [AdminCompanyMailListController::class, 'deleteEditmailList'])->name('ecoulex.kanri.deleteEditlistmailaddressdetail');


//会員企業管理
//お問い合わせ管理（会員企業管理ページ）
Route::get('/lp/mirai_project/kanri/adminCompanyInfo', [AdminCompanyInfoController::class, 'index'])->name('ecoulex.kanri.adminCompanyInfo');
Route::post('/lp/mirai_project/kanri/adminCompanyInfo', [AdminCompanyInfoController::class, 'sendCompanyPassword'])->name('ecoulex.kanri.sendCompanyPassword');

Route::post('/lp/mirai_project/kanri/companiesSearch', [AdminCompanyInfoController::class, 'companiesSearch'])->name('ecoulex.kanri.companiesSearch');


//会員企業登録
Route::get('/lp/mirai_project/kanri/createAdminCompanyInfo/', [EditAdminCompanyInfoController::class, 'showCreateAdminCompany'])->name('ecoulex.kanri.createadminCompanyInfo');
Route::get('/lp/mirai_project/kanri/createEditAdminCompanyInfo/', [EditAdminCompanyInfoController::class, 'createEditAdminCompanyInfo'])->name('ecoulex.kanri.createEditAdminCompanyInfo');
Route::post('/lp/mirai_project/kanri/createEditAdminCompanyInfo/', [EditAdminCompanyInfoController::class, 'createEditAdminCompanyInfo'])->name('ecoulex.kanri.createEditAdminCompanyInfo');

//会員企業更新
Route::get('/lp/mirai_project/kanri/editAdminCompanyInfo/company_id/{company_id}', [EditAdminCompanyInfoController::class, 'showEditAdminCompany'])->name('ecoulex.kanri.editadminCompanyInfo');
Route::get('/lp/mirai_project/kanri/editAdminCompanyInfo/complete', [EditAdminCompanyInfoController::class, 'updateEditAdminCompanyInfo'])->name('ecoulex.kanri.updateEditAdminCompanyInfo');
Route::post('/lp/mirai_project/kanri/editAdminCompanyInfo/complete', [EditAdminCompanyInfoController::class, 'updateEditAdminCompanyInfo'])->name('ecoulex.kanri.updateEditAdminCompanyInfo');

//会員企業削除
Route::get('/lp/mirai_project/kanri/delAdminCompanyInfo/company_id/{company_id}', [EditAdminCompanyInfoController::class, 'showdelEditAdminCompany'])->name('ecoulex.kanri.delEditAdminCompanyInfo');
Route::get('/lp/mirai_project/kanri/delAdminCompanyInfo/complete', [EditAdminCompanyInfoController::class, 'deleteEditAdminCompanyInfo'])->name('ecoulex.kanri.deleteEditAdminCompanyInfo');
Route::post('/lp/mirai_project/kanri/delAdminCompanyInfo/complete', [EditAdminCompanyInfoController::class, 'deleteEditAdminCompanyInfo'])->name('ecoulex.kanri.deleteEditAdminCompanyInfo');

//企業情報管理

//企業情報トップ
Route::get('/lp/mirai_project/kanri/showAdminCompanyDetail', [AdminCompanyDetailInfoController::class, 'index'])->name('ecoulex.kanri.adminCompanyDetailInfo');

//メールアドレス一覧検索
Route::post('/lp/mirai_project/kanri/showAdminCompanyDetail', [AdminCompanyDetailInfoController::class, 'companiesDetailSearch'])->name('ecoulex.kanri.companiesDetailSearch');

//企業情報更新
Route::get('/lp/mirai_project/kanri/editAdminCompanyDetailInfo/company_id/{company_id}', [EditAdminCompanyDetailInfoController::class, 'showEditAdminCompanyDetail'])->name('ecoulex.kanri.editAdminCompanyDetailInfo');
Route::get('/lp/mirai_project/kanri/editAdminCompanyDetailInfo/complete', [EditAdminCompanyDetailInfoController::class, 'updateCompanyDetailInfo'])->name('ecoulex.kanri.updateEditAdminCompanyDetailInfo');
Route::post('/lp/mirai_project/kanri/editAdminCompanyDetailInfo/complete', [EditAdminCompanyDetailInfoController::class, 'updateCompanyDetailInfo'])->name('ecoulex.kanri.updateEditAdminCompanyDetailInfo');

//企業情報削除
Route::get('/lp/mirai_project/kanri/delAdminCompanyDetailInfo/company_id/{company_id}', [EditAdminCompanyDetailInfoController::class, 'showdelEditAdminCompanyDetail'])->name('ecoulex.kanri.deleditAdminCompanyDetail');
Route::get('/lp/mirai_project/kanri/delAdminCompanyDetailInfo/complete', [EditAdminCompanyDetailInfoController::class, 'deleteEditAdminCompanyDetailInfo'])->name('ecoulex.kanri.deleteEditAdminCompanyDetail');
Route::post('/lp/mirai_project/kanri/delAdminCompanyDetailInfo/complete', [EditAdminCompanyDetailInfoController::class, 'deleteEditAdminCompanyDetailInfo'])->name('ecoulex.kanri.deleteEeleditAdminCompanyDetail');


//求人情報
Route::get('/lp/mirai_project/kanri/adminjobPostingInfo', [AdminjobPostingInfoController::class, 'index'])->name('ecoulex.kanri.adminjobPostingInfo');

//求人情報一覧検索
Route::post('/lp/mirai_project/kanri/adminjobPostingInfo', [AdminjobPostingInfoController::class, 'jobPostingSearch'])->name('ecoulex.kanri.jobPostingSearch');

//求人情報更新
Route::get('/lp/mirai_project/kanri/editAdminjobPostingInfo/company_id/{company_id}', [EditAdminjobPostingInfoController::class, 'showAdminjobPostingInfo'])->name('ecoulex.kanri.editAdminjobPostingInfo');
Route::get('/lp/mirai_project/kanri/editAdminjobPostingInfo/complete', [EditAdminjobPostingInfoController::class, 'updateEditAdminjobPostingInfo'])->name('ecoulex.kanri.updateEditAdminjobPostingInfo');
Route::post('/lp/mirai_project/kanri/editAdminjobPostingInfo/complete', [EditAdminjobPostingInfoController::class, 'updateEditAdminjobPostingInfo'])->name('ecoulex.kanri.updateEditAdminjobPostingInfo');

//求人情報削除
Route::get('/lp/mirai_project/kanri/delAdminjobPostingInfo/company_id/{company_id}', [EditAdminjobPostingInfoController::class, 'showdelAdminjobPostingInfo'])->name('ecoulex.kanri.deleditAdminjobPostingInfo');
Route::get('/lp/mirai_project/kanri/delAdminjobPostingInfo/complete', [EditAdminjobPostingInfoController::class, 'delEditAdminjobPostingInfo'])->name('ecoulex.kanri.delEditAdminjobPostingInfo');
Route::post('/lp/mirai_project/kanri/delAdminjobPostingInfo/complete', [EditAdminjobPostingInfoController::class, 'delEditAdminjobPostingInfo'])->name('ecoulex.kanri.delEditAdminjobPostingInfo');


//防水情報
Route::get('/lp/mirai_project/kanri/adminWaterProofInfo', [AdminWaterProofInfoController::class, 'index'])->name('ecoulex.kanri.adminWaterProofInfo');
// Route::post('/lp/mirai_project/kanri/adminWaterProofInfo', [AdminWaterProofInfoController::class, 'sendWaterProofPassword'])->name('ecoulex.kanri.sendWaterProofPassword');

//求人情報一覧検索
Route::post('/lp/mirai_project/kanri/adminWaterProofInfo', [AdminWaterProofInfoController::class, 'waterProofingSearch'])->name('ecoulex.kanri.waterProofingSearch');

//防水情報更新
Route::get('/lp/mirai_project/kanri/editAdminWaterProofInfo/company_id/{company_id}', [EditAdminWaterProofInfoController::class, 'showAdminWaterProofInfo'])->name('ecoulex.kanri.editAdminWaterProofInfo');
Route::get('/lp/mirai_project/kanri/editAdminWaterProofInfo/complete', [EditAdminWaterProofInfoController::class, 'updateEditAdminWaterProofInfo'])->name('ecoulex.kanri.updateEditAdminWaterProofInfo');
Route::post('/lp/mirai_project/kanri/editAdminWaterProofInfo/complete', [EditAdminWaterProofInfoController::class, 'updateEditAdminWaterProofInfo'])->name('ecoulex.kanri.updateEditAdminWaterProofInfo');

//防水情報削除
Route::get('/lp/mirai_project/kanri/delAdminWaterProofInfo/company_id/{company_id}', [EditAdminWaterProofInfoController::class, 'showdelAdminWaterProofInfo'])->name('ecoulex.kanri.deleditAdminWaterProofInfo');
Route::get('/lp/mirai_project/kanri/delAdminWaterProofInfo/complete', [EditAdminWaterProofInfoController::class, 'delEditAdminWaterProofInfo'])->name('ecoulex.kanri.delEditAdminWaterProofInfo');
Route::post('/lp/mirai_project/kanri/delAdminWaterProofInfo/complete', [EditAdminWaterProofInfoController::class, 'delEditAdminWaterProofInfo'])->name('ecoulex.kanri.delEditAdminWaterProofInfo');

//CSVアップロード
Route::get('/lp/mirai_project/kanri/showcsvUpload', [CsvUploadController::class, 'showcsvUpload'])->name('ecoulex.kanri.showcsvUpload');

Route::post('/lp/mirai_project/kanri/importCompaniesCsv', [CsvUploadController::class, 'importCompaniesCsv'])->name('ecoulex.kanri.importCompaniesCsv');

Route::post('/lp/mirai_project/kanri/importCompaniesdetailsCsv', [CsvUploadController::class, 'importCompaniesdetailsCsv'])->name('ecoulex.kanri.importCompaniesdetailsCsv');

Route::post('/lp/mirai_project/kanri/importJoboffersCsv', [CsvUploadController::class, 'importJoboffersCsv'])->name('ecoulex.kanri.importJoboffersCsv');

Route::post('/lp/mirai_project/kanri/importWaterProofingCsv', [CsvUploadController::class, 'importWaterProofingCsv'])->name('ecoulex.kanri.importWaterProofingCsv');