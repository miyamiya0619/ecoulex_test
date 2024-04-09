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
            <h2>エコ・ウレックス工業会 お問い合わせ管理</h2>
        </div>
        <div class="login-form">
            <form action="{{ route('ecoulex.kanri.forgot_password_complete') }}" method="post" novalidate>
            @csrf <!-- CSRFトークンを含める -->
                <div class="form-content">
                    <p>パスワードを再発行します。<br>
                        ご登録のメールアドレスへ新しいパスワードを<br>
                        通知いたしますのでご確認ください。
                    </p>
                    <input type="email" name="email" id="email" required>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <button type="submit">パスワードを再発行する</button>
                    <div class="attention">
                        ※メールがが届かない場合はsystem@eco-ulex.comのアドレスの受信許可をしていただくか事務局までお問い合わせください。
                    </div>
                </div>
            </form>
        </div>
</body>

</html>