<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エコ・ウレックス工業会</title>
    <!-- CSSファイルの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/admin/admin_common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/pagination.css') }}">
    <meta name="robots" content="noindex">
    <!-- 個別のCSSファイルの読み込み -->
    @yield('css')
    <!-- jQueryの読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div id="header-container">
        <header>
            <nav id="admin-nav">
                <div class="menu-title">
                    事務局メニュー
                </div>
                <ul>
                    <li><a href="{{ route('ecoulex.kanri.adminDashboard') }}">●TOP（インフォメーション）</a></li>
                    <li><a href="{{ route('ecoulex.kanri.adminCompanyInfo') }}">●会員企業管理</a></li>
                    <!-- <li><a href="#">●企業情報管理</a></li>
                    <li><a href="#">●防水情報管理</a></li>
                    <li><a href="#">●CSVアップロード</a></li> -->
                    <li><a href="{{ route('showCpmanyLoginForm') }}">ログアウト</a></li>
                </ul>
                <div class="nav-company-name">
                    @yield('company_name', 'デフォルトの企業名')
                </div>
            </nav>
        </header>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

    <!-- JavaScriptファイルの読み込み -->
    <script src="{{ asset('js/admin/admin_common.js') }}"></script>
</body>

</html>
