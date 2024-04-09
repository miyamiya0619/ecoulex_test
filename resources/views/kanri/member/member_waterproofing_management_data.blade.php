@extends('layouts.member_app')
@section('title', '防水工事管理')

@section('company_name', $user -> company_name)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/member/common_management.css') }}">
@endsection
@section('content')
        <div class="dashboard-container">
            <div class="information-section">
                <div class="info-header">
                    <h1 class="dashboard-title">防水工事管理</h1>
                </div>
                @include('partials._company_info_header')
@php
$catAndIdsArray  = json_decode($worterProofs[0]->catAndIds, true);
$idValue = $catAndIdsArray[0]['id'];
@endphp                
@if(!empty($idValue))
                <div class="information-item">
                    <div class="information-content">
                        <div class="box-info">
                            <ul>
                                <li>
                                    <div class="inquiry_content">
                                        <div class="label">お問い合わせ募集内容:</div>
                                        <ul>
                                        @foreach($catAndIdsArray as $catName)
                                        <li>{{ $catName['name'] }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="label">防水工事用キャッチ:</div>
                                    <div class="catch">{{ $worterProofs[0]->waterproofing_job_catch }}</div>
                                </li>
                                <li>
                                    <div class="label">防水工事用詳細:</div>
                                    <div class="catch">{{ $worterProofs[0]-> waterproofing_job_description}}</div>
                                </li>
                                <li>
                                    <div class="image">
                                        <div class="label">防水工事用画像:</div>
                                        <div>
                                            <img class="fit-picture"
                                                src="{{ asset('images/uploads/' . $worterProofs[0]->waterproofing_job_image) }}"
                                                alt="{{ $worterProofs[0]->waterproofing_job_image}}" />
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="info-button">
                        <a href="{{ route('ecoulex.kanri.editMemberWaterproofing') }}">
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
                    <a href="{{ route('ecoulex.kanri.editMemberWaterproofing') }}">
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