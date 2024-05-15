@extends('layouts.admin_app')

@section('title', 'お問い合わせ管理画面トップ')

@section('company_name', $user -> company_name)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/admin_dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/admin_csv.css') }}">
@endsection

@section('content')
    <div class="dashboard-container">
        <p>エコウレックス工業会</p>
        <h1 class="dashboard-title">CSVアップロード</h1>
        @if(isset($status) && $status != "")
            <p class="message"> {{ $status }}</p>
        @endif
        <div class="dashboard-box">
            <div class="dashboard-content">
                <p class="dashboard-content__head">会員企業登録</p>
                <form action="{{ route('ecoulex.kanri.importCompaniesCsv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="file-input-wrapper">
                        <label for="companies_csv_file" class="file-label">ファイルを選択</label>
                        <input type="file" name="companies_csv_file" id="companies_csv_file" class="file-input" onchange="displaycompanies(this)">
                        <span id="file-name_companies"></span>
                    </div>
                    <button type="submit" class="upload-button-black">+ CSVアップロード</button>
                </form>
            </div>
        </div>

        <div class="dashboard-box">
            <div class="dashboard-content">
                <p class="dashboard-content__head">ページ情報登録</p>
                <div class="upload_contents">
                    <form action="{{ route('ecoulex.kanri.importCompaniesdetailsCsv') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="file-input-wrapper">
                            <label for="companiesdetails_csv_file" class="file-label">ファイルを選択</label>
                            <input type="file" name="companiesdetails_csv_file" id="companiesdetails_csv_file" class="file-input" onchange="displaycompaniesdetails(this)">
                            <span id="file-name_companiesdetails"></span>
                        </div>
                        <button type="submit" class="upload-button-black">+ 企業情報CSVアップロード</button>
                    </form>
                </div>
                <div class="upload_contents">
                    <form action="{{ route('ecoulex.kanri.importWaterProofingCsv') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="file-input-wrapper">
                            <label for="WaterProofing_csv_file" class="file-label">ファイルを選択</label>
                            <input type="file" name="WaterProofing_csv_file" id="WaterProofing_csv_file" class="file-input" onchange="displaywaterProofing(this)">
                            <span id="file-name_waterProofing"></span>
                        </div>
                        <button type="submit" class="upload-button-black">+ 防水工事CSVアップロード</button>
                    </form>
                </div>
                <div class="upload_contents">
                    <form action="{{ route('ecoulex.kanri.importJoboffersCsv') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="file-input-wrapper">
                            <label for="joboffers_csv_file" class="file-label">ファイルを選択</label>
                            <input type="file" name="joboffers_csv_file" id="joboffers_csv_file" class="file-input" onchange="displayjoboffers(this)">
                            <span id="file-name_joboffers"></span>
                        </div>
                        <button type="submit" class="upload-button-black">+ 求人情報CSVアップロード</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- 初回リリース時は未実施 -->
            <!-- ページネーション -->
@endsection
