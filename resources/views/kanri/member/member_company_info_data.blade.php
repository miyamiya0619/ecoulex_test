@extends('layouts.admin_app')
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
                <div class="information-item">
                    <div class="information-content">
                        <div class="box-info">
                            <ul>
                                <li>
                                    <span class="label">URL:</span>
                                    <span class="URL">〇〇〇〇〇〇〇〇〇〇〇〇</span>
                                </li>
                                <li>
                                    <span class="label">所在地:</span>
                                    <span class="address">〇〇〇〇〇〇〇〇〇〇〇〇</span>
                                </li>
                                <li>
                                    <span class="label">社員数:</span>
                                    <span class="number-of-employees">〇〇〇〇〇〇〇〇〇〇〇〇</span>
                                </li>
                                <li>
                                    <span class="label">設立年:</span>
                                    <span class="establishment-date">〇〇〇〇〇〇〇〇〇〇〇〇</span>
                                </li>
                                <li>
                                    <span class="label">資本金:</span>
                                    <span class="capital">〇〇〇〇〇〇〇〇〇〇〇〇</span>
                                </li>
                                <li>
                                    <span class="label">代表者:</span>
                                    <span class="representative">〇〇〇〇〇〇〇〇〇〇〇〇</span>
                                </li>
                                <li>
                                    <span class="label">電話番号:</span>
                                    <span class="phone-number">〇〇〇〇〇〇〇〇〇〇〇〇</span>
                                </li>
                                <li>
                                    <span class="label">フォーム:</span>
                                    <span class="form-mail">〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇</span>
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


            </div>
            <!-- ページネーション -->

        </div>
    </div>
</body>

</html>
@endsection