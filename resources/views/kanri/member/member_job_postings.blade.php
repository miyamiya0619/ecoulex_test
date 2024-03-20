@extends('layouts.admin_app')
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
                <div class="information-item">
                    <div class="information-content">
                        <div class="box-info">
                            <ul>
                                <li>
                                    <div class="inquiry_content">
                                        <div class="label">お問い合わせ募集内容:</div>
                                        <ul>
                                        @php
                                            $catNamesArray = explode(',', str_replace(['[', ']'], '', $companies[0]->catNames));
                                        @endphp

                                        @foreach($catNamesArray as $catName)
                                        <li>{{ $catName }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="label">求人情報キャッチ:</div>
                                    <div class="catch">{{ $companies[0]->prefecuture_catch_head }}</div>
                                </li>
                                <li>
                                    <div class="label">求人情報詳細:</div>
                                    <div class="detail">{{ $companies[0]->prefecuture_catch_reading }}</div>
                                </li>
                                <li>
                                    <div class="image">
                                        <div class="label">求人情報画像:</div>
                                        <div>
                                            <img class="fit-picture"
                                                src="{{ asset('images/uploads/' . $companies[0]->prefecuture_image) }}"
                                                alt="{{ $companies[0]->prefecuture_image}}" />
                                        </div>
                                    </div>

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


            </div>
            <!-- ページネーション -->

        </div>
    </div>
</body>

</html>
@endsection