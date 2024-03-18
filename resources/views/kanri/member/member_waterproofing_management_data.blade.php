@extends('layouts.admin_app')
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
                <div class="information-item">
                    <div class="information-content">
                        <div class="box-info">
                            <ul>
                                <li>
                                    <div class="inquiry_content">
                                        <div class="label">お問い合わせ募集内容:</div>
                                        <ul>
                                            <li>ビル</li>
                                            <li>マンションの屋上
                                            </li>
                                            <li>ベランダ</li>
                                            <li>外壁</li>
                                            <li>外階段
                                            </li>
                                            <li>廊下
                                            </li>
                                            <li>シーリング改修
                                            </li>
                                            <li>コンクリート補修
                                            </li>
                                            <li>金属屋根
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="label">防水工事用キャッチ:</div>
                                    <div class="catch">〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇</div>
                                </li>
                                <li>
                                    <div class="image">
                                        <div class="label">防水工事用画像:</div>
                                        <div>
                                            <img class="fit-picture"
                                                src="https://user0514.cdnw.net/shared/img/thumb/mzubotty-DSC_0308-8593_TP_V.jpg"
                                                alt="水位が下がったために足元まで姿を見せる明治用水旧頭首工の導水堤の石組みと取水口付近で作業をする巨大なクレーン" />
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


            </div>
            <!-- ページネーション -->

        </div>
    </div>
</body>

</html>
@endsection