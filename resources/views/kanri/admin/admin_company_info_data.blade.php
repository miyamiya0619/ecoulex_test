@extends('layouts.admin_app')

@section('title', 'お問い合わせ管理画面トップ')

@section('company_name', $user -> company_name)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/admin_dashboard.css') }}">
@endsection

@section('content')
        <div class="dashboard-container">
            <div class="information-section">
                <div class="info-header">
                    <h1 class="dashboard-title">会員企業管理</h1>
                    <!-- <div class="search-container">
                        <input type="text" placeholder="検索">
                        <button class="search-button">検索</button>
                    </div> -->
                </div>
                <form method="POST" action="{{ route('ecoulex.kanri.sendCompanyPassword') }}">
                    @csrf <!-- CSRFトークンを含める -->
                    <div> <button class="password-button">パスワードを通知する</button></div>
                    <div class="select_all"> <input type="checkbox" id="select-all">すべて選択する<br></div>
                    <p class="message">{{ session('status') }}</p>
                    <div class="information-box">
                        @foreach($companies as $company)
                            <div class="information-item">
                                <div class="information-content">
                                <div class="infomartion_chkbox"><input type="checkbox" name="selected_items[]" value="{{ $company->company_id }}"></div>
                                <div class="information_txt">
                                    <div class="company-name">{{$company -> company_name}}</div>
                                    <div class="info-update ">企業名カナ：{{$company -> company_name_kana}}</div>
                                    <div class="info-mail ">登録メールアドレス：{{$company -> email}}</div>
                                </div>
                                </div>
                                <!-- 削除 -->
                                <!-- <div class="button_group">
                                    <div class="info-button">
                                        <button class="delete-edit-button-design">編集</button>
                                    </div>
                                    <div class="info-button">
                                        <button class="delete-edit-button-design delete-button">削除</button>
                                    </div>
                                </div> -->
                            </div>
                        @endforeach
                    </div>
                </form>
            </div>
            <!-- ページネーション -->

        </div>

        <div class="pagination contents">
                <!-- Previous Button -->
                @if ($companies->currentPage() == 1)
                    
                @else
                    <a href="{{ $companies->url($companies->currentPage() - 1) }}">«</a>
                @endif

                <!-- Page Numbers -->
                @php
                    // 現在のページ番号を取得
                    $currentPage = $companies->currentPage();
                    // ページ番号の範囲を計算
                    $start = max(1, $currentPage - 2);
                    $end = min($start + 4, $companies->lastPage());
                    // ページ番号が5未満の場合は最大5ページ目まで表示する
                    if ($end < 5) {
                        $end = min(5, $companies->lastPage());
                    }
                @endphp
                @for ($i = $start; $i <= $end; $i++)
                    @if ($i == $companies->currentPage())
                        <span>{{ $i }}</span>
                    @else
                        <a href="{{ $companies->url($i) }}">{{ $i }}</a>
                    @endif
                @endfor

                <!-- Next Button -->
                @if ($companies->currentPage() == $companies->lastPage())
                    
                @else
                    <a href="{{ $companies->url($companies->currentPage() + 1) }}">»</a>
                @endif
        </div><!-- /resultNav -->

 @endsection