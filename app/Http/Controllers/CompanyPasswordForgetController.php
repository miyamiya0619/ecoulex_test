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
        $email = $request->email;

        // emailカラムでユーザーを検索
        $company = Company::where('email', $email)->first();
        //emailカラムにユーザが入っている場合、emailとpasswordカラムでメール送信
        if ($company) {
            $newPassword = Str::random(10);
            $newPasswordhash = Hash::make($newPassword);
            $company->password = $newPasswordhash;
            $company->updated_at = now();
            $company->save();

            Mail::to($company)->send(new ForgetdMail($newPassword));
        }

        // email2カラムでユーザーを検索
        $company2 = Company::where('email2', $email)->first();
        //email2カラムにユーザが入っている場合、email2とpassword2カラムでメール送信
        if ($company2) {
            $newPassword = Str::random(10);
            $newPasswordhash = Hash::make($newPassword);
            $company2->password2 = $newPasswordhash;
            $company2->updated_at = now();
            $company2->save();

            Mail::to($company2->email2)->send(new ForgetdMail($newPassword));
        }

        // email3カラムでユーザーを検索
        $company3 = Company::where('email3', $email)->first();
        //email2カラムにユーザが入っている場合、email2とpassword2カラムでメール送信
        if ($company3) {
            $newPassword = Str::random(10);
            $newPasswordhash = Hash::make($newPassword);
            $company3->password3 = $newPasswordhash;
            $company3->updated_at = now();
            $company3->save();

            Mail::to($company3->email3)->send(new ForgetdMail($newPassword));
        }

        if ($company || $company2 || $company3) {

            return view('kanri.registration.forgot_password_complete', [
                'email' => $email,
            ]);
        } else {
            // 企業が見つからない場合の処理
            return back()->withErrors(['email' => 'このメールアドレスに対応する企業は見つかりませんでした。']);
        }

    }
    
}
