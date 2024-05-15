@extends('layouts.admin_app')

@section('title', 'お問い合わせ管理画面トップ')

@section('company_name', $user -> company_name)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/admin_dashboard.css') }}">
@endsection

@section('content')
    <div class="dashboard-container">
        <p>エコウレックス工業会</p>
        <h1 class="dashboard-title">インフォメーション</h1>

        <div class="dashboard-box">
            <div class="dashboard-content">
                <h3 class="dashboard-content__head">{{$information[0]->updated_at}} {{$information[0]->company_name}}が以下の情報を更新しました</h3>
                <p>更新対象ページ：</p>
                <p>・{{$information[0]->information_name}}</p>
            </div>
        </div>
        <div class="info-button__back">
            <a href="{{ route('ecoulex.kanri.adminDashboard') }}" class="info-button">
                <button>一覧に戻る</button>
            </a>
        </div>
    </div>
    <!-- 初回リリース時は未実施 -->
            <!-- ページネーション -->
@endsection
