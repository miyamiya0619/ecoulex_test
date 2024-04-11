@extends('layouts.member_app')
@section('title', '求人情報管理')

@section('company_name', $user -> company_name)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/member/common_management.css') }}">
@endsection
@section('content')
        <div class="dashboard-container">
            <div class="information-section">
                <div class="info-header">
                    <h1 class="dashboard-title">求人情報管理</h1>
                </div>
                @include('partials._company_info_header')
@if($jobPostings[0]->prefectureName)
                <div class="information-item">
                    <div class="information-content">
                        <div class="box-info">
                            <ul>
                                <li>
                                    <div class="inquiry_content">
                                        <div class="label">求人募集内容:</div>
                                        <ul>
                                        @php
                                        $catNamesArray = json_decode($jobPostings[0]['catAndIds'], true);
                                        $catNames = array_column($catNamesArray, 'catName');
                                        @endphp

                                        @foreach($catNames as $catName)
                                        <li>{{ $catName }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="label">求人情報キャッチ:</div>
                                    <div class="catch">{{ $jobPostings[0]->prefecuture_catch_head }}</div>
                                </li>
                                <li>
                                    <div class="label">求人情報詳細:</div>
                                    <div class="detail">{{ $jobPostings[0]->prefecuture_catch_reading }}</div>
                                </li>
                                <li>
                                    <div class="image">
                                        <div class="label">求人情報画像:</div>
                                        <div>
                                            <img class="fit-picture"
                                                src="{{ asset('images/uploads/' . $jobPostings[0]->prefecuture_image) }}"
                                                alt="{{ $jobPostings[0]->prefecuture_image}}" />
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="label">勤務地:</div>
                                    <div class="detail">〒{{ $jobPostings[0]->address_num }}{{ $jobPostings[0]->prefectureName }}{{ $jobPostings[0]->addressDetail }}</div>
                                </li>
                                <li>
                                    <div class="label">勤務時間:</div>
                                    <div class="detail">{{ $jobPostings[0]->working_hours }}</div>
                                </li>
                                <li>
                                    <div class="label">初年度月収例:</div>
                                    <div class="detail">{{ $jobPostings[0]->monthly_income }}</div>
                                </li>
                                <li>
                                    <div class="label">応募➀電話:</div>
                                    <div class="detail">{{ $jobPostings[0]->offer1_by_tel }}</div>
                                </li>
                                <li>
                                    <div class="label">応募➀フォーム:</div>
                                    <div class="detail">{{ $jobPostings[0]->offer1_by_form }}</div>
                                </li>
                                <li>
                                    <div class="label">応募➁電話:</div>
                                    <div class="detail">{{ $jobPostings[0]->offer2_by_tel }}</div>
                                </li>
                                <li>
                                    <div class="label">応募➁フォーム:</div>
                                    <div class="detail">{{ $jobPostings[0]->offer2_by_form }}</div>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="info-button">
                        <a href="{{ route('ecoulex.kanri.editMemberJobPostings') }}">
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
        <a href="{{ route('ecoulex.kanri.editMemberJobPostings') }}">
            <button class="registration-button">新規登録する</button>
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