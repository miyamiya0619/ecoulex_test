<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="{{ asset('css/registration/forgot_password.css') }}">
</head>

<body>
    <div class="login-container">

        <div class="side-bar">
            <h2>エコ・ウレックスお問い合わせ管理</h2>
        </div>
        <div class="login-form">
                <div class="form-content">
                    <p>以下のパスワードに送信しました。<br>ご確認いただき、ログインを実施していただきますようよろしくお願いします。</p>
                    <p>×××××@example.com</p>
                    <a href="{{ route('showCpmanyLoginForm') }}">
                    <button type="submit">ログイン画面</button>
                    </a>
                </div>
        </div>
</body>

</html>