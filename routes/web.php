<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchContactController;
use App\Http\Controllers\SearchRecruitController;
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
// Route::get('/ecoulex/recruit/', [SearchRecruitController::class, 'index'])->name('index');
// Route::get('/ecoulex/recruit/result', [SearchRecruitController::class, 'recruit_search'])->name('recruit_search');

