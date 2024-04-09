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
                    <p>ログイン履歴など</p>
                </div>
            </div>

            <div class="information-section">
                <div class="info-header">
                    <h3 class="info-title">インフォメーション</h3>
                    <div class="search-container">
                        <input type="text" placeholder="検索">
                        <button class="search-button">検索</button>
                    </div>
                </div>
                <div class="information-box">
                    <div class="information-item">
                        <div class="information-content">
                            <span class="date">YYYY/MM/DD</span>
                            <span class="info-text">●●●●●●●●が情報を更新しました。</span>
                        </div>
                        <a href="admin_information.html" class="info-button">
                            <button>確認する</button>
                        </a>
                    </div>
                    <div class="information-item">
                        <div class="information-content">
                            <span class="date">YYYY/MM/DD</span>
                            <span class="info-text">●●●●●●●●が情報を更新しました。</span>
                        </div>

                        <a href="admin_information.html" class="info-button">
                            <button>確認する</button>
                        </a>
                    </div>
                </div>
            </div>
    </div>
            <!-- ページネーション -->
        <div class="pagination">
            <a href="#">&laquo;</a>
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">&raquo;</a>
        </div>
@endsection
