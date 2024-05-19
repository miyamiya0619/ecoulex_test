<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Str;
use App\Models\Company;
use App\Mail\ForgetdMail;

class CompanyPasswordForgetController extends Controller
{

    public function index()
    {
        return view('kanri.registration.forgot_password');
    }


    public function forgot_password_complete(Request $request)
    {

        $rules = [
            'email' => 'required|email',
        ];

        $messages = [
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '有効なメールアドレスを入力してください。',
        ];

            // バリデーションを実行
        $validator = Validator::make($request->all(), $rules, $messages);

        // バリデーションに失敗した場合
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ユーザーのパスワードを更新
        $company = null;
        $passwordColumn = 'password';

        $email = $request->email;

        // emailカラムでユーザーを検索
        $company = Company::where('email', $email)->first();
        if (!$company) {
            // email2カラムでユーザーを検索
            $company = Company::where('email2', $email)->first();
            $passwordColumn = 'password2';
        }
        if (!$company) {
            // email3カラムでユーザーを検索
            $company = Company::where('email3', $email)->first();
            $passwordColumn = 'password3';
        }

        if ($company) {
            $newPassword = Str::random(10); // 10文字のランダムな文字列を生成する例

            // パスワードカラムを動的に更新
            $company->$passwordColumn = Hash::make($newPassword);
            $company->save();

            // メール送信
            // Mail::to($company)->send(new ForgetdMail($newPassword));

            return view('kanri.registration.forgot_password_complete', [
                'email' => $email,
            ]);
        } else {
            // 企業が見つからない場合の処理
            return back()->withErrors(['email' => 'このメールアドレスに対応する企業は見つかりませんでした。']);
        }

    }
    
}
