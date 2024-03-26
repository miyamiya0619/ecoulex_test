<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchContactController;
use App\Http\Controllers\SearchRecruitController;
use App\Http\Controllers\Auth\CompanyLoginController;
use App\Http\Controllers\MemberTopController;
use App\Http\Controllers\MemberCompanyInfoController;
use App\Http\Controllers\MemberWaterproofingManagementController;
use App\Http\Controllers\MemberJobPostingsController;
use App\Http\Controllers\EditMemberCompanyInfoController;
use App\Http\Controllers\EditMemberWaterproofingController;
use App\Http\Controllers\EditMemberJobPostingsController;
use App\Http\Controllers\CompanyPasswordForgetController;



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
Route::get('/ecoulex/', function () {
    return view('top');
});

// challenger
Route::get('/ecoulex/challenger/', function () {
    return view('challenger/top');
});

//ヘッダーCONTACT→防水工事・各種工事のご相談
//contact(4/12では関東のみのリリース)

// Route::get('/ecoulex/contact/', function () {
//     return view('contact/top');
// });

Route::get('/ecoulex/contact/', [SearchContactController::class, 'index'])->name('index');
Route::post('/ecoulex/contact/', [SearchContactController::class, 'index'])->name('index');


//contact(5月では全域のリリース)
// Route::get('/ecoulex/contact/', function () {
//     return view('contact/top01');
// });

//防水工事・各種工事のご相談の検索処理
//contact(4/12では関東のみのリリース)

Route::post('/ecoulex/contact/result/', [SearchContactController::class, 'contact_search'])->name('contact_search');
Route::get('/ecoulex/contact/result', [SearchContactController::class, 'contact_search_pagers'])->name('contact_search_pagers');

//future
Route::get('/ecoulex/future/', function () {
    return view('future/top');
});

//lab
Route::get('/ecoulex/lab/', function () {
    return view('lab/top');
});

//message
Route::get('/ecoulex/message/', function () {
    return view('message/top');
});

//recruit
Route::get('/ecoulex/recruit/', [SearchRecruitController::class, 'index'])->name('index');
Route::get('/ecoulex/recruit/result/prefecture/{prefecture_id}', [SearchRecruitController::class, 'recruit_search'])->name('recruit_search');

Route::get('/ecoulex/recruit/result', [SearchRecruitController::class, 'recruit_search_all'])->name('recruit_search_all');
Route::get('/ecoulex/recruit/result/region/{region_id}', [SearchRecruitController::class, 'recruit_search_region'])->name('recruit_search_region');



// 管理画面（企業側）

// ログイン
Route::get('/ecoulex/kanri/loginCopmany/', [CompanyLoginController::class, 'showCpmanyLoginForm'])->name('showCpmanyLoginForm');
Route::post('/ecoulex/kanri/loginCopmany/', [CompanyLoginController::class, 'login'])->name('login');

//お問い合わせ管理（トップページ）
Route::get('/ecoulex/kanri/memberDashboard', [MemberTopController::class, 'index'])->name('ecoulex.kanri.memberDashboard');

//お問い合わせ管理（企業情報管理ページ）
Route::get('/ecoulex/kanri/memberCompanyInfo', [MemberCompanyInfoController::class, 'index'])->name('ecoulex.kanri.memberCompanyInfo');
Route::get('/ecoulex/kanri/editMemberCompanyInfo', [EditMemberCompanyInfoController::class, 'index'])->name('ecoulex.kanri.editMemberCompanyInfo');
Route::post('/ecoulex/kanri/editMemberCompanyInfo', [EditMemberCompanyInfoController::class, 'updateCompanyInfo'])->name('ecoulex.kanri.editMemberCompanyInfo.updateCompanyInfo');

//お問い合わせ管理（防水工事管理ページ）
Route::get('/ecoulex/kanri/memberWaterproofingManagement', [MemberWaterproofingManagementController::class, 'index'])->name('ecoulex.kanri.memberWaterproofingManagement');
Route::get('/ecoulex/kanri/editMemberWaterproofing', [EditMemberWaterproofingController::class, 'index'])->name('ecoulex.kanri.editMemberWaterproofing');
Route::post('/ecoulex/kanri/editMemberWaterproofing', [EditMemberWaterproofingController::class, 'updateWaterProofingInfo'])->name('ecoulex.kanri.editMemberWaterproofing');

//お問い合わせ管理（求人情報管理ページ）
Route::get('/ecoulex/kanri/memberJobPostings', [MemberJobPostingsController::class, 'index'])->name('ecoulex.kanri.memberJobPostings');
Route::get('/ecoulex/kanri/editMemberJobPostings', [EditMemberJobPostingsController::class, 'index'])->name('ecoulex.kanri.editMemberJobPostings');
Route::post('/ecoulex/kanri/editMemberJobPostings', [EditMemberJobPostingsController::class, 'updateJobPostingInfo'])->name('ecoulex.kanri.updateJobPostingInfo');

//パスワード忘れ
Route::get('/ecoulex/kanri/forgot_password', [CompanyPasswordForgetController::class, 'index'])->name('ecoulex.kanri.forgot_password');
