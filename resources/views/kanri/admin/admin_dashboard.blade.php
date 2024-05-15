@extends('layouts.admin_app')

@section('title', 'お問い合わせ管理画面トップ')

@section('company_name', $user -> company_name)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/admin_dashboard.css') }}">
@endsection

@section('content')

    <div class="dashboard-container">
        <p>エコウレックス工業会</p>
        <h1 class="dashboard-title">お問い合わせ事務局画面トップ</h1>

        <div class="dashboard-box">
            <h3>ダッシュボード</h3>
            <div class="dashboard-content">
            ログイン履歴: 
            @foreach ($companyLoginT as $companyLoginData)
                <p>{{ $companyLoginData->created_at }}</p>
            @endforeach
            </div>
        </div>
<!-- 初回リリース時は未実施 -->
            <div class="information-section">
            <form action="{{route('ecoulex.kanri.dashboardSearch')}}" method="post" novalidate>
@csrf <!-- CSRFトークンを含める -->
                <div class="info-header">
                    <h3 class="info-title">インフォメーション</h3>
                    <div class="search-container">
                        <input type="text" name="search_freeword" placeholder="検索" value="{{ $search_freeword ?? '' }}">
                        <button class="search-button">検索</button>
                    </div>
                </div>
                </form>
                @if(isset($status) && $status != "")
                    <p class="message"> {{ $status }}</p>
                @endif
                @if ($information->isEmpty())
                    <div class="information-box">検索対象の企業は存在しません。</div>
                @else
                    <div class="information-box">
                        @foreach ($information as $informationData)
                            <div class="information-item">
                                <div class="information-content">
                                    <span class="date">{{ $informationData->updated_at }}</span>
                                    <span class="info-text">{{ $informationData->company_name }}が情報を更新しました。</span>
                                </div>
                                <a href="{{ route('ecoulex.kanri.showAdminDashboard', ['id' => $informationData->id ]) }}" class="info-button">
                                    <button>確認する</button>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
    </div>
    <!-- 初回リリース時は未実施 -->
            <!-- ページネーション -->
            @if (!($information->isEmpty()))
            <div class="pagination contents">
                <!-- Previous Button -->
                @if ($information->currentPage() == 1)
                    
                @else
                    <a href="{{ $information->url($information->currentPage() - 1) }}">«</a>
                @endif

                <!-- Page Numbers -->
                @php
                    // 現在のページ番号を取得
                    $currentPage = $information->currentPage();
                    // ページ番号の範囲を計算
                    $start = max(1, $currentPage - 2);
                    $end = min($start + 4, $information->lastPage());
                    // ページ番号が5未満の場合は最大5ページ目まで表示する
                    if ($end < 5) {
                        $end = min(5, $information->lastPage());
                    }
                @endphp
                @for ($i = $start; $i <= $end; $i++)
                    @if ($i == $information->currentPage())
                        <span>{{ $i }}</span>
                    @else
                        <a href="{{ $information->url($i) }}">{{ $i }}</a>
                    @endif
                @endfor

                <!-- Next Button -->
                @if ($information->currentPage() == $information->lastPage())
                    
                @else
                    <a href="{{ $information->url($information->currentPage() + 1) }}">»</a>
                @endif
            </div><!-- /resultNav -->
            @endif

        
@endsection
