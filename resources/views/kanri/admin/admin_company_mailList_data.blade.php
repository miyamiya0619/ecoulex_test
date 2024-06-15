@extends('layouts.admin_app')

@section('title', 'お問い合わせ管理画面トップ')

@section('company_name', $user -> company_name)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/admin_dashboard.css') }}">
@endsection

@section('content')
        <div class="dashboard-container">
            <div class="information-section">
                <form action="{{route('ecoulex.kanri.mailListSearch')}}" method="post" novalidate>
                    <div class="info-header_com">
                        <h1 class="dashboard-title">会員企業管理</h1>
                        <div class="dashboard__bottom">
                            <p>企業担当メールアドレス一覧</p>
                            <div class="search-container">
                                <input type="text" name="search_freeword" placeholder="検索" value="{{ $search_freeword ?? '' }}">
                                <button class="search-button">検索</button>
                            </div>
                        </div>
                    </div>
                    
                    @csrf <!-- CSRFトークンを含める -->
                    @if(isset($status) && $status != "")
                        <p class="message"> {{ $status }}</p>
                    @endif
                    @if ($emailsAndNames == null)
                    <div class="information-box">検索対象の求人は存在しません。</div>
                    @else
                    <div class="information-box">
                        @foreach($emailsAndNames as $emailsAndName)
                            <div class="information-item">
                                <div class="information-content">
                                <div class="information_txt">
                                    <div class="info-update" maxlength="100">メールアドレス：{{$emailsAndName['email']}}</div>
                                    <div class="info-mail ">企業名：{{$emailsAndName['company_name']}}</div>
                                </div>
                                </div>
                                <!-- 削除 -->
                                <div class="button_group">
                                    <div class="info-button">
                                        <a href="{{ route('ecoulex.kanri.editlistmailaddressdetail', ['company_id' => $emailsAndName['company_id'], 'm_id' => $emailsAndName['m_id']]) }}" class="info-button">編集</a>
                                    </div>
                                    <div class="info-button" class="info-button">
                                        <a href="{{ route('ecoulex.kanri.dellistmailaddressdetail', ['company_id' => $emailsAndName['company_id'], 'm_id' => $emailsAndName['m_id']]) }}" class="info-button">削除</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </form>
            </div>
            <!-- ページネーション -->
            @if (empty($search_freeword))
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
            @endif
        </div>
 @endsection