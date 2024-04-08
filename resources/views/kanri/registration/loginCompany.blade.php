<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="{{ asset('css/registration/login.css') }}">
</head>

<body>
    <div class="login-container">
        <div class="side-bar">
            <h2>エコ・ウレックス工業会 お問い合わせ管理</h2>
        </div>
        <div class="login-form">
            <h2>ログイン</h2>
            <form method="POST" action="{{ route('showCpmanyLoginForm') }}">
                @csrf <!-- CSRFトークンを含める -->
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input type="password" id="password" name="password" placeholder="パスワード" required>
                </div>
                @if($errors->has('loginError'))
                    <div class="alert alert-danger"><span style="color: red;">{{ $errors->first('loginError') }}</span></div>
                @endif
                <button type="submit">ログインする</button>
            </form>
            <a href="{{ route('ecoulex.kanri.forgot_password') }}" class="forgot-password">パスワードを忘れた場合</a>
        </div>
    </div>
</body>

</html>