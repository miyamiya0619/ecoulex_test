@extends('layouts.admin_app')

@section('title', 'お問い合わせ管理画面トップ')

@section('company_name', $user -> company_name)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/admin_dashboard.css') }}">
@endsection

@section('content')
    <div class="main-content">
        <div class="dashboard-container">
            <div class="information-section">
                <div class="info-header">
                    <h1 class="dashboard-title">会員企業管理</h1>
                    <div class="search-container">
                        <input type="text" placeholder="検索">
                        <button class="search-button">検索</button>

                    </div>
                </div>
                <div class="information-box">
                    <div class="information-item">
                        <div class="information-content">
                        <div class="company-name">株式会社〇〇〇〇〇〇〇〇〇〇〇〇</div>
                            <div class="info-update ">企業名カナ：〇〇〇〇〇〇〇〇〇〇</div>
                            <div class="info-mail ">登録メールアドレス：〇〇〇〇〇〇〇〇〇</div>
                        </div>
                        <div class="button_group">
                            <div class="info-button">
                                <button class="delete-edit-button-design">編集</button>
                            </div>
                            <div class="info-button">
                                <button class="delete-edit-button-design delete-button">削除</button>
                            </div>
                        </div>
                    </div>
                    <div class="information-item">
                        <div class="information-content">
                        <div class="company-name">株式会社〇〇〇〇〇〇〇〇〇〇〇〇</div>
                            <div class="info-update ">企業名カナ：〇〇〇〇〇〇〇〇〇〇</div>
                            <div class="info-mail ">登録メールアドレス：〇〇〇〇〇〇〇〇〇</div>
                        </div>
                        <div class="button_group">
                            <div class="info-button">
                                <button class="delete-edit-button-design">編集</button>
                            </div>
                            <div class="info-button">
                                <button class="delete-edit-button-design delete-button">削除</button>
                            </div>
                        </div>

                    </div>
                    <div class="information-item">
                        <div class="information-content">
                        <div class="company-name">株式会社〇〇〇〇〇〇〇〇〇〇〇〇</div>
                            <div class="info-update ">企業名カナ：〇〇〇〇〇〇〇〇〇〇</div>
                            <div class="info-mail ">登録メールアドレス：〇〇〇〇〇〇〇〇〇</div>
                        </div>
                        <div class="button_group">
                            <div class="info-button">
                                <button class="delete-edit-button-design">編集</button>
                            </div>
                            <div class="info-button">
                                <button class="delete-edit-button-design delete-button">削除</button>
                            </div>
                        </div>

                    </div>
                    <div class="information-item">
                        <div class="information-content">
                        <div class="company-name">株式会社〇〇〇〇〇〇〇〇〇〇〇〇</div>
                            <div class="info-update ">企業名カナ：〇〇〇〇〇〇〇〇〇〇</div>
                            <div class="info-mail ">登録メールアドレス：〇〇〇〇〇〇〇〇〇</div>
                        </div>
                        <div class="button_group">
                            <div class="info-button">
                                <button class="delete-edit-button-design">編集</button>
                            </div>
                            <div class="info-button">
                                <button class="delete-edit-button-design delete-button">削除</button>
                            </div>
                        </div>

                    </div>
                    <div class="information-item">
                        <div class="information-content">
                            <div class="company-name">株式会社〇〇〇〇〇〇〇〇〇〇〇〇</div>
                            <div class="info-update ">企業名カナ：〇〇〇〇〇〇〇〇〇〇</div>
                            <div class="info-mail ">登録メールアドレス：〇〇〇〇〇〇〇〇〇</div>
                        </div>
                        <div class="button_group">
                            <div class="info-button">
                                <button class="delete-edit-button-design">編集</button>
                            </div>
                            <div class="info-button">
                                <button class="delete-edit-button-design delete-button">削除</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- ページネーション -->

        </div>
        <div class="pagination">
            <a href="#">&laquo;</a>
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">&raquo;</a>
        </div>
    </div>
 @endsection