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
                    <h1 class="dashboard-title">企業情報管理</h1>
                </div>
                @include('partials._company_info_header')
                <div class="information-item">
                <form action="{{ route('ecoulex.kanri.editMemberCompanyInfo.updateCompanyInfo') }}" method="post">
                @csrf <!-- CSRFトークンを含める -->
                    <div class="information-content">
                        <div class="box-info">
                            <ul>
                                <li>
                                    <span class="label">URL:</span>
                                    <input type="text" class="URL" name="url" value="{{ $companies[0] -> url }}">
                                </li>

                                <li>
                                    <span class="label">郵便番号:</span>
                                    <input type="text" class="zip_code" name="address_num" value="{{ $companies[0] -> address_num }}" required>
                                </li>

                                <li>
                                    <span class="label">
                                        都道府県名：
                                    </span>
                                    <select name="prefectureId" id="prefecture" required>
                                    @foreach($prefectures as $prefecture)
                                        @if($prefecture->prefecuture_id == $companies[0]->prefecuture_id)
                                        <option value="{{$prefecture -> prefecuture_id}}" selected>{{$prefecture -> catName}}</option>
                                        @else
                                        <option value="{{$prefecture -> prefecuture_id}}">{{$prefecture -> catName}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </li>

                                <li>
                                    <span class="label">所在地:</span>
                                    <input type="text" class="address" value="{{ $companies[0] -> addressDetail }}" name="addressDetail" required>
                                </li>
                                <li>
                                    <span class="label">社員数:</span>
                                    <input type="text" class="number-of-employees" value="{{ $companies[0] -> number_of_employees }}" name="number_of_employees">
                                </li>
                                <li>
                                    <span class="label">設立年:</span>
                                    <input type="text" class="establishment-date" value="{{ $companies[0] -> year_of_establishment }}" name="year_of_establishment">
                                </li>
                                <li>
                                    <span class="label">資本金:</span>
                                    <input type="text" class="capital" value="{{ $companies[0] -> capital }}" name="capital">
                                </li>
                                <li>
                                    <span class="label">代表者:</span>
                                    <input type="text" class="representative" value="{{ $companies[0] -> representative }}" name="representative" required>
                                </li>
                                <li>
                                    <span class="label">電話番号:</span>
                                    <input type="text" class="phone-number" value="{{ $companies[0] -> phone }}" name="phone">
                                </li>
                                <li>
                                    <span class="label">フォーム:</span>
                                    <input type="text" class="form-mail" value="{{ $companies[0] -> form }}" name="form">
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="info-button">
                        <button class="registration-button" onclick="validateForm()">更新する</button>
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