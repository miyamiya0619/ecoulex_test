@extends('layouts.member_app')

@section('title', 'お問い合わせ管理画面トップ')

@section('company_name', $user -> company_name)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/member/member_dashboard.css') }}">
@endsection

@section('content')
    <div class="dashboard-container">
        <p>エコウレックス工業会</p>
        <h1 class="dashboard-title">お問い合わせ管理画面トップ</h1>

        <div class="dashboard-box">
            <h3>ダッシュボード</h3>
            <div class="dashboard-content">
            ログイン履歴: 
                @foreach ($companyLoginT as $companyLoginData)
                    <p>{{ $companyLoginData->created_at }}</p>
                @endforeach
            </div>
        </div>

        <a target=_blank href="https://docs.google.com/presentation/d/1YaWBWRP5jP75vxccWhuMSAp3km7neeXj3e51QBesJw8/edit#slide=id.p" class="update-method">操作・更新方法　＞</a>
    </div>
@endsection
