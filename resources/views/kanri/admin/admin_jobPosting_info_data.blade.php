@extends('layouts.admin_app')

@section('title', '求人情報管理')

@section('company_name', $user -> company_name)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/admin_dashboard.css') }}">
@endsection

@section('content')
        <div class="dashboard-container">
            <div class="information-section">
            <form  action="{{route('ecoulex.kanri.jobPostingSearch')}}" method="post" novalidate>
                <div class="info-header_com">
                    <h1 class="dashboard-title">求人情報管理</h1>
                    <div class="search_group">
                        <div></div>
                        <div class="search-container search-container">
                            <form action="{{ url()->current() }}" method="GET">
                            @csrf <!-- CSRFトークンを含める -->
                                <input type="text" name="search_freeword" placeholder="検索" value="{{ $search_freeword ?? '' }}">
                                <button class="search-button">検索</button>
                            </form>
                        </div>
                    </div>
                </div>
                @csrf <!-- CSRFトークンを含める -->
                @if(isset($status) && $status != "")
                    <p class="message"> {{ $status }}</p>
                @endif
                @if ($jobPostings->isEmpty())
                    <div class="information-box">検索対象の求人は存在しません。</div>
                @else
                <div class="information-box">
                    @foreach($jobPostings as $jobPosting)
                        <div class="information-item">
                            <div class="information-content">
                            <div class="jobPosting_txt">
                                <div class="jobPosting-name">{{$jobPosting -> company_name}}</div>
                                <div class="jobPosting-updatetime"><span class="strong">情報更新日：</span>{{$jobPosting -> updated_at}}</div>
                            </div>
                            </div>
                            <!-- 削除 -->
                            <div class="button_group">
                                <div class="info-button">
                                    <a href="{{route('ecoulex.kanri.editAdminjobPostingInfo', ['company_id' => $jobPosting->company_id ])}}" class="info-button">編集</a>
                                </div>
                                <div class="info-button" class="info-button">
                                    <a href="{{route('ecoulex.kanri.deleditAdminjobPostingInfo', ['company_id' => $jobPosting->company_id ])}}" class="info-button">削除</a>
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

        @php
            // 検索条件を配列にまとめる
            $queryParams = [
            'search_freeword' => request('search_freeword'),
            // 他の検索条件があればここに追加
            ];
        @endphp
        @if (!($jobPostings->isEmpty()))
        <div class="pagination contents">
                <!-- Previous Button -->
                @if ($jobPostings->currentPage() == 1)
                    
                @else
                    <a href="{{ $jobPostings->appends($queryParams)->url($jobPostings->currentPage() - 1) }}">«</a>
                @endif

                <!-- Page Numbers -->
                @php
                    // 現在のページ番号を取得
                    $currentPage = $jobPostings->currentPage();
                    // ページ番号の範囲を計算
                    $start = max(1, $currentPage - 2);
                    $end = min($start + 4, $jobPostings->lastPage());
                    // ページ番号が5未満の場合は最大5ページ目まで表示する
                    if ($end < 5) {
                        $end = min(5, $jobPostings->lastPage());
                    }
                @endphp
                @for ($i = $start; $i <= $end; $i++)
                    @if ($i == $jobPostings->currentPage())
                        <span>{{ $i }}</span>
                    @else
                        <a href="{{ $jobPostings->appends($queryParams)->url($i) }}">{{ $i }}</a>
                    @endif
                @endfor

                <!-- Next Button -->
                @if ($jobPostings->currentPage() == $jobPostings->lastPage())
                    
                @else
                    <a href="{{ $jobPostings->appends($queryParams)->url($jobPostings->currentPage() + 1) }}">»</a>
                @endif
        </div><!-- /resultNav -->
        @endif
 @endsection