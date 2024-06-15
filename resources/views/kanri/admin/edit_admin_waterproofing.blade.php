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
                    <h1 class="dashboard-title">防水情報管理</h1>
                </div>
                <div class="information-item">
                <form action="{{ route('ecoulex.kanri.updateEditAdminWaterProofInfo') }}" method="post" enctype="multipart/form-data" novalidate>
                @csrf <!-- CSRFトークンを含める -->
                    <div class="information-content">
                        <div class="box-info">
                        @if(isset($status) && $status != "")
                        <p class="message"> {{ $status }}</p>
                        @endif
                        @if(isset($errors) && !empty($errors))
                            @foreach ($errors as $field => $messages)
                                @foreach ($messages as $message)
                                    <p class="message">{{ $message }}</p>
                                @endforeach
                            @endforeach
                        @endif
                        <p class="message"> {{ session('status') }}</p>
                            <div class="form-group">
                                <label class="form-label">企業名:</label>
                                <p>{{$WarterProofs[0] -> company_name}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">防水工事募集内容:</label>
                                <div class="checkboxWaterproofing">
                                @foreach($WarterProofCatAll as $WarterProofCat)
                                    @if(in_array($WarterProofCat -> waterproofcat_id, json_decode($WarterProofs[0]->catIds)))
                                    <div><input type="checkbox" name="WaterProofingCat[]" value="{{$WarterProofCat -> waterproofcat_id}}" required checked>{{$WarterProofCat -> catName}}</div>
                                    @else
                                    <div><input type="checkbox" name="WaterProofingCat[]" value="{{$WarterProofCat -> waterproofcat_id}}" required>{{$WarterProofCat -> catName}}</div>
                                    @endif
                                @endforeach
                                <div class="required-asterisk_long"><span style="color: red;">* 少なくとも一つ選択必須</span></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label">
                                <label> 防水工事用キャッチ:</label>
                                <div class="form-attention">
                                        ※文字数30文字まで
                                    </div>
                                </div>
                                <input type="text" name="waterproofing_job_catch" value="{{$WarterProofs[0] -> waterproofing_job_catch}}" maxlength="30">
                            </div>
                            <div class="form-group">
                                <div class="form-label">
                                    <label>防水工事用詳細:</label>
                                    <div class="form-attention">
                                        ※文字数100文字まで
                                    </div>
                                </div>
                                <textarea name="waterproofing_job_description" rows="4" cols="50" maxlength="100">{{$WarterProofs[0] -> waterproofing_job_description}}</textarea>
                            </div>

                            <div class="form-group">
                                <div class="form-label">
                                    <label>防水工事用画像:</label>
                                    <div class="form-attention">
                                        ※推奨サイズ 横240px×縦160px
                                    </div>

                                </div>
                                <div class="file-upload">
                                    <button type="button" id="upload-btn">ファイルを選択</button>
                                    <input type="file" id="file-upload" name="waterproofing_job_image" style="display: none;">
                                    <div class="selected-file-name"></div>
                                    @if ($WarterProofs[0]->waterproofing_job_image)
                                        <div class="Img"><img src="{{ asset('images/uploads/' . $WarterProofs[0]->waterproofing_job_image) }}" alt=""></div>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="company_id" value="{{ $WarterProofs[0]->company_id}}">
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