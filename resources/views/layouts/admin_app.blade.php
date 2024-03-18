<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- CSSファイルの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/member/member_common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/pagination.css') }}">
    <!-- 個別のCSSファイルの読み込み -->
    @yield('css')
    <!-- jQueryの読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div id="header-container">
        <header>
            <nav id="member-nav">
                <div class="menu-title">
                    会員用メニュー
                </div>
                <ul>
                    <li><a href="{{ route('ecoulex.kanri.memberDashboard') }}">●TOP</a></li>
                    <li><a href="{{ route('ecoulex.kanri.memberCompanyInfo') }}">●企業情報管理</a></li>
                    <li><a href="{{ route('ecoulex.kanri.memberWaterproofingManagement') }}">●防水工事管理</a></li>
                    <li><a href="{{ route('ecoulex.kanri.memberJobPostings') }}">●求人情報管理</a></li>
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
    <script src="{{ asset('js/member/member_common.js') }}"></script>
</body>

</html>
