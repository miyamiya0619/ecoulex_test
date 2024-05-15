@extends('layouts.admin_app')
@section('title', '企業情報管理編集画面')

@section('company_name', $user -> company_name)

@section('css')
<link rel="stylesheet" href="{{ asset('css/member/common_management.css') }}">
@endsection

@section('content')

        <div class="dashboard-container">
            <div class="information-section">
                <div class="info-header">
                    <h1 class="dashboard-title">会員企業管理</h1>
                </div>
                <div class="information-item">
                <form action="{{route('ecoulex.kanri.createEditAdminCompanyInfo')}}" method="post" novalidate>
                @csrf <!-- CSRFトークンを含める -->
                    <div class="information__head">新規企業登録</div>
                    <div class="information-content">
                        <div class="box-info">
                        @if(isset($status) && $status != "")
                        <p class="message"> {{ $status }}</p>
                        @endif
                            <ul>
                                <li>
                                    <span class="label">企業名:</span>
                                    <input type="text" class="company_name" name="company_name" value="@if(Session::has('createEditAdminCompanyAll')){{ Session::get('createEditAdminCompanyAll')['company_name'] }} @endif"><span class="required-asterisk">* 必須</span>
                                </li>

                                <li>
                                    <span class="label">企業名カナ:</span>
                                    <input type="text" class="company_name_kana" name="company_name_kana" value="@if(Session::has('createEditAdminCompanyAll')){{ Session::get('createEditAdminCompanyAll')['company_name_kana'] }} @endif"><span class="required-asterisk">* 必須</span>
                                </li>
                                <li>
                                    <span class="label">編集担当<br>メールアドレス1:</span>
                                    <input type="text" class="email" name="email" value="@if(Session::has('createEditAdminCompanyAll')){{ Session::get('createEditAdminCompanyAll')['email'] }} @endif"><span class="required-asterisk">* 必須</span>
                                </li>
                                <li>
                                    <span class="label">編集担当<br>メールアドレス2:</span>
                                    <input type="text" class="email2" name="email2" value="@if(Session::has('createEditAdminCompanyAll')){{ Session::get('createEditAdminCompanyAll')['email2'] }} @endif">
                                </li>
                                <li>
                                    <span class="label">編集担当<br>メールアドレス3:</span>
                                    <input type="text" class="email3" name="email3" value="@if(Session::has('createEditAdminCompanyAll')){{ Session::get('createEditAdminCompanyAll')['email3'] }} @endif">
                                </li>
                            </ul>
                            <input type="hidden" name="createCompany_id" value="{{ $createCompany_id }}">
                        </div>
                    </div>
                    <div class="info-button">
                        <button class="registration-button" onclick="validateForm()">登録する</button>
                    </div>
                </form>
                </div>
            </div>
            <!-- ページネーション -->
        </div>
    </div>

</body>

</html>
@endsection