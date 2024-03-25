@extends('layouts.admin_app')
@section('title', '防水工事管理編集画面')

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
                <form action="{{ route('ecoulex.kanri.editMemberCompanyInfo.updateCompanyInfo') }}" method="post">
                @csrf <!-- CSRFトークンを含める -->
                    <div class="information-content">
                        <div class="box-info">
                            <div class="form-group">
                                <label class="form-label">防水工事募集内容:</label>
                                <div class="checkboxWaterproofing">
                                @foreach($worterProofCatAll as $worterProofCat)
                                    @if(in_array($worterProofCat -> waterproofcat_id, json_decode($worterProofs[0]->catIds)))
                                    <div><input type="checkbox" name="services[]" value="{{$worterProofCat -> waterproofcat_id}}" checked>{{$worterProofCat -> catName}}</div>
                                    @else
                                    <div><input type="checkbox" name="services[]" value="{{$worterProofCat -> waterproofcat_id}}">{{$worterProofCat -> catName}}</div>
                                    @endif
                                @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">防水工事用見出し:</label>
                                <input type="text" name="midashi" value="{{$worterProofs[0] -> waterproofing_job_catch}}">
                            </div>
                            <div class="form-group">
                                <div class="form-label">
                                    <label>防水工事用キャッチ:</label>
                                    <div class="form-attention">
                                        ※文字数100文字まで
                                    </div>

                                </div>

                                <textarea name="catchphrase" rows="4" cols="50" maxlength="〇〇">{{$worterProofs[0] -> waterproofing_job_description}}</textarea>
                            </div>

                            <div class="form-group">
                                <div class="form-label">
                                    <label>防水工事用画像:</label>
                                    <div class="form-attention">
                                        ※推奨サイズ〇〇
                                    </div>

                                </div>
                                <div class=" file-upload">
                                    <button type="button" id="upload-btn">ファイルを選択</button>
                                    <input type="file" id="file-upload" style="display: none;">
                                    <div class="selected-file-name"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="info-button">
                        <button class="registration-button" onclick="validateForm()">更新する</button>
                    </div>


                </div>
                </form>

            </div>
            <!-- ページネーション -->

        </div>
    </div>

</body>

</html>
@endsection