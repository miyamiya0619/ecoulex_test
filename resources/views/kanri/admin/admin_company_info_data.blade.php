@extends('layouts.admin_app')

@section('title', 'お問い合わせ管理画面トップ')

@section('company_name', $user -> company_name)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/admin_dashboard.css') }}">
@endsection

@section('content')
        <div class="dashboard-container">
            <div class="information-section">
                <div class="info-header_com">
                    <h1 class="dashboard-title">会員企業管理</h1>
                    <form method="POST" action="{{ route('ecoulex.kanri.companiesSearch') }}">
                    @csrf <!-- CSRFトークンを含める -->
                        <div class="button__group">
                            <div class="button__create">
                                <div class="search-container">
                                    <input type="text" name="search_freeword" placeholder="検索" value="{{ $search_freeword ?? '' }}">
                                    <button class="search-button">検索</button>
                                </div>
                            </div>
                            <div class="button_list">
                                <div class="button__mail"><a href="{{route('ecoulex.kanri.listmailaddress')}}">会員担当メールアドレス一覧</a></div>
                                <div class="button__password"><a href="{{route('ecoulex.kanri.listNotsendPassword')}}">パスワード未送信企業検索</a></div>
                            </div>
                        </div>
                    </form>
                </div>
                <form method="POST" action="{{ route('ecoulex.kanri.sendCompanyPassword') }}">
                    @csrf <!-- CSRFトークンを含める -->
                    <div class="dashboard__button-group"> 
                        <button class="password-button">パスワードを通知する</button>
                    </div>
                    <div class="select_all"> <input type="checkbox" id="select-all">すべて選択する<br></div>
                    @if(isset($status) && $status != "")
                        <p class="message"> {{ $status }}</p>
                    @endif
                    @if ($companies->isEmpty())
                    <div class="information-box">検索対象の企業は存在しません。</div>
                     @else
                    <div class="information-box">
                        @foreach($companies as $company)
                            <div class="information-item">
                                <div class="information-content">
                                <div class="infomartion_chkbox"><input type="checkbox" name="selected_items[]" value="{{ $company->company_id }}"></div>
                                <div class="information_txt">
                                    <div class="company-name">{{$company -> company_name}}</div>
                                    <div class="info-update ">企業名カナ：{{$company -> company_name_kana}}</div>
                                    <div class="info-mail ">登録メールアドレス1：{{$company -> email}}</div>
                                    <div class="info-mail ">登録メールアドレス2：{{$company -> email2}}</div>
                                    <div class="info-mail ">登録メールアドレス3：{{$company -> email3}}</div>
                                    <div class="info-update ">更新日時：{{$company -> updated_at}}</div>
                                    <div class="info-update">
                                        初回パスワード：
                                        @if($company->send_flg == 1)
                                            送信済
                                        @else
                                            未送信
                                        @endif
                                    </div>
                                </div>
                                </div>
                                <!-- 削除 -->
                                <div class="button_group">
                                    <div class="info-button">
                                        <a href="{{route('ecoulex.kanri.editadminCompanyInfo', ['company_id' => $company->company_id ])}}" class="info-button">編集</a>
                                    </div>
                                    <div class="info-button" class="info-button">
                                        <a href="{{route('ecoulex.kanri.delEditAdminCompanyInfo', ['company_id' => $company->company_id ])}}" class="info-button">削除</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </form>
            </div>
            <!-- ページネーション -->

        </div>
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
 @endsection