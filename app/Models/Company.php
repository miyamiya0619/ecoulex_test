<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable; // 追加

class Company extends Model implements Authenticatable 
{
    use HasFactory;

     protected $primaryKey = 'company_id';

    // 以下のメソッドを実装する

    public function getAuthIdentifier()
    {
        // ユーザーの識別子を返す
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        // ユーザーのパスワードを返す
        return $this->password;
    }

    public function getRememberToken()
    {
        // ユーザーの「remember me」トークンを返す
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        // ユーザーの「remember me」トークンを設定する
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        // 「remember me」トークンのカラム名を返す
        return 'remember_token';
    }

    public function getAuthIdentifierName()
    {
        // ユーザーの識別子を返す
        return $this->getKey();
    }
}
