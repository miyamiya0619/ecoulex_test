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
                                            <li>現場作業員
                                            </li>
                                            <li>現場調査診断士
                                            </li>
                                            <li>現場管理監督員
                                            </li>
                                            <li>現場・営業サポー
                                                ト（現場事務、精
                                                算等）</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="label">求人情報キャッチ:</div>
                                    <div class="catch">〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇</div>
                                </li>
                                <li>
                                    <div class="image">
                                        <div class="label">求人情報画像:</div>
                                        <div>
                                            <img class="fit-picture"
                                                src="https://user0514.cdnw.net/shared/img/thumb/ookawa221061281_TP_V.jpg"
                                                alt="書類選考中の男性" />
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