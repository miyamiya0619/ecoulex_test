@extends('layouts.member_app')
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
                <form action="{{ route('ecoulex.kanri.editMemberCompanyInfo.updateCompanyInfo') }}" method="post" novalidate>
                @csrf <!-- CSRFトークンを含める -->
                    <div class="information-content">
                        <div class="box-info">
                        @if(session('status'))
                            <p class="message">{{ session('status') }}</p>
                        @endif
                        @if(isset($errors) && !empty($errors))
                            @foreach ($errors as $field => $messages)
                                @foreach ($messages as $message)
                                    <p class="message">{{ $message }}</p>
                                @endforeach
                            @endforeach
                        @endif
                            <ul>
                                <li>
                                    <span class="label">WEBサイト:</span>
                                    <input type="text" class="URL" name="url" value="{{ $companies[0] -> url }}" maxlength="100">
                                </li>

                                <li>
                                    <span class="label">郵便番号:</span>
                                    <input type="text" class="zip_code" name="address_num" value="{{ $companies[0] -> address_num }}" maxlength="15" required>
                                </li>

                                <li>
                                    <span class="label">
                                        都道府県名：
                                    </span>
                                    <select name="prefectureId" id="prefecture" maxlength="50" required>
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
                                    <input type="text" class="address" value="{{ $companies[0] -> addressDetail }}" name="addressDetail" maxlength="50" required>
                                </li>
                                <li>
                                    <span class="label">社員数:</span>
                                    <input type="text" class="number-of-employees" value="{{ $companies[0] -> number_of_employees }}" name="number_of_employees" maxlength="30">
                                </li>
                                <li>
                                    <span class="label">設立年:</span>
                                    <input type="text" class="establishment-date" value="{{ $companies[0] -> year_of_establishment }}" name="year_of_establishment" maxlength="30">
                                </li>
                                <li>
                                    <span class="label">資本金:</span>
                                    <input type="text" class="capital" value="{{ $companies[0] -> capital }}" name="capital" maxlength="30">
                                </li>
                                <li>
                                    <span class="label">代表者:</span>
                                    <input type="text" class="representative" value="{{ $companies[0] -> representative }}" name="representative" maxlength="30" required>
                                </li>
                                <li>
                                    <span class="label">電話番号:</span>
                                    <input type="text" class="phone-number" value="{{ $companies[0] -> phone }}" name="phone" maxlength="30">
                                </li>
                                <li>
                                    <span class="label">フォーム:</span>
                                    <input type="text" class="form-mail" value="{{ $companies[0] -> form }}" name="form" maxlength="100">
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