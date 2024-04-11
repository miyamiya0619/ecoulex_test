@extends('layouts.member_app')
@section('title', '企業情報管理')

@section('company_name', $user -> company_name)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/member/common_management.css') }}">
@endsection

@section('content')

        <div class="dashboard-container">
            <div class="information-section">
                <div class="info-header">
                    <h1 class="dashboard-title">企業情報管理</h1>
                </div>
                @include('partials._company_info_header')
@if($companies[0]->address_num)
                <div class="information-item">
                    <div class="information-content">
                        <div class="box-info">
                            <ul>
                                <li>
                                    <span class="label">WEBサイト:</span>
                                    <span class="URL">{{ $companies[0] -> url }}</span>
                                </li>
                                <li>
                                    <span class="label">所在地:</span>
                                    <span class="address">〒{{ $companies[0] -> address_num }}  {{ $companies[0] -> prefectureName }}{{ $companies[0] -> addressDetail }}</span>
                                </li>
                                <li>
                                    <span class="label">社員数:</span>
                                    <span class="number-of-employees">{{ $companies[0] -> number_of_employees }}</span>
                                </li>
                                <li>
                                    <span class="label">設立年:</span>
                                    <span class="establishment-date">{{ $companies[0] -> year_of_establishment }}</span>
                                </li>
                                <li>
                                    <span class="label">資本金:</span>
                                    <span class="capital">{{ $companies[0] -> capital }}</span>
                                </li>
                                <li>
                                    <span class="label">代表者:</span>
                                    <span class="representative">{{ $companies[0] -> representative }}</span>
                                </li>
                                <li>
                                    <span class="label">電話番号:</span>
                                    <span class="phone-number">{{ $companies[0] -> phone }}</span>
                                </li>
                                <li>
                                    <span class="label">フォーム:</span>
                                    <span class="form-mail">{{ $companies[0] -> form }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="info-button">
                        <a href="{{ route('ecoulex.kanri.editMemberCompanyInfo') }}">
                            <button class="registration-button">編集する
                            </button>
                        </a>
                    </div>
                </div>
@else
<div class="information-item">
                    <div class="information-content">
                        <div class="no-box-info">登録情報がありません</div>

                    </div>
                    <div class="info-button">
                    <a href="{{ route('ecoulex.kanri.editMemberCompanyInfo') }}">
                        <button class="registration-button">新規登録する
                        </button>
                    </a>
                    </div>
</div>
@endif
            </div>
            <!-- ページネーション -->

        </div>
    </div>
</body>

</html>
@endsection