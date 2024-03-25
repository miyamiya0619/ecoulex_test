@extends('layouts.admin_app')

@section('title', 'お問い合わせ管理画面トップ')

@section('company_name', $user -> company_name)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/member/member_dashboard.css') }}">
@endsection

@section('content')
    <div class="dashboard-container">
        <h1 class="dashboard-title">お問い合わせ管理画面トップ</h1>

        <div class="dashboard-box">
            <h3>ダッシュボード</h3>
            <div class="dashboard-content">
                @foreach ($companyLoginT as $companyLoginData)
                    <p>ログイン履歴: {{ $companyLoginData->created_at }}</p>
                @endforeach
            </div>
        </div>

        <a href="#" class="update-method">操作・更新方法　＞</a>
    </div>
@endsection
