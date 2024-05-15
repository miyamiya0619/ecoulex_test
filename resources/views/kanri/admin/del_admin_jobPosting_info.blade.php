@extends('layouts.admin_app')
@section('title', '求人情報管理編集画面')

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
                <div class="information-item">
                <form action="{{ route('ecoulex.kanri.delEditAdminjobPostingInfo') }}" method="post" enctype="multipart/form-data" novalidate>
                @csrf <!-- CSRFトークンを含める -->
                    <div class="information-content">
                        <div class="box-info">
                        @if(isset($status) && $status != "")
                        <p class="message"> {{ $status }}</p>
                        @endif
                            <div class="form-group">
                                <label class="form-label">企業名:</label>
                                <p>{{$jobPostings[0] -> company_name}}</p>

                            </div>
                            <div class="form-group">
                                <label class="form-label">求人募集内容:</label>
                                <div class="checkbox">
                                @php
                                $catNamesArray = json_decode($jobPostings[0]['catAndIds'], true);
                                $jobcatIds = array_column($catNamesArray, 'jobcat_id');
                                @endphp
                                @foreach($JobofferdetailCatAll as $JobofferdetailCat)
                                @if(in_array($JobofferdetailCat -> jobcat_id, $jobcatIds))
                                    <div><input type="checkbox" name="JobofferdetailCat[]" value="{{$JobofferdetailCat -> jobcat_id}}" checked disabled> {{$JobofferdetailCat -> catName}}</div>
                                    @else
                                    <div><input type="checkbox" name="JobofferdetailCat[]" value="{{$JobofferdetailCat -> jobcat_id}}" disabled> {{$JobofferdetailCat -> catName}}</div>
                                    @endif
                                @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label">
                                <label>求人情報キャッチ:</label>
                                <div class="form-attention">
                                        ※文字数30文字まで
                                    </div>
                                    </div>
                                <input type="text" name="prefecuture_catch_head" value="{{$jobPostings[0] -> prefecuture_catch_head}}"maxlength="30"  readonly>
                            </div>
                            <div class="form-group">
                                <div class="form-label">
                                    <label>求人情報詳細:</label>
                                    <div class="form-attention">
                                        ※文字数100文字まで
                                    </div>
                                </div>
                                <textarea name="prefecuture_catch_reading" rows="5" cols="100" maxlength="100"  readonly>{{$jobPostings[0] -> prefecuture_catch_reading}}</textarea>
                            </div>

                            <div class="form-group">
                                <div class="form-label">
                                    <label>求人用画像:</label>
                                    <div class="form-attention">
                                        ※推奨サイズ 横240px×縦160px
                                    </div>

                                </div>
                                <div class="file-upload">
                                    <button type="button" id="upload-btn"  disabled>ファイルを選択</button>
                                    <input type="file" id="file-upload" name="prefecuture_image" style="display: none;">
                                    <div class="selected-file-name"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="prefecture">都道府県名:</label>
                                <select name="prefectureId" id="prefecture" required  disabled>
                                @foreach($prefectures as $prefecture)
                                    @if($prefecture->prefecuture_id == $jobPostings[0]->prefecuture_id)
                                    <option value="{{$prefecture -> prefecuture_id}}" selected>{{$prefecture -> catName}}</option>
                                    @else
                                    <option value="{{$prefecture -> prefecuture_id}}">{{$prefecture -> catName}}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label class="form-label">勤務地:</label>
                                <input type="text" value= "{{$jobPostings[0] -> addressDetail}}" name="addressDetail"  readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label">勤務時間:</label>
                                <input type="text" value= "{{$jobPostings[0] -> working_hours}}" name="working_hours"  readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label">初年度月収例:</label>
                                <input type="text" value= "{{$jobPostings[0] -> monthly_income}}" name="monthly_income" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label">応募①電話:</label>
                                <input type="text" value= "{{$jobPostings[0] -> offer1_by_tel}}" name="offer1_by_tel" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label">応募①フォーム:</label>
                                <input type="text" value= "{{$jobPostings[0] -> offer1_by_form}}" name="offer1_by_form" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label">応募②電話:</label>
                                <input type="text" value= "{{$jobPostings[0] -> offer2_by_tel}}" name="offer2_by_tel" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label">応募②フォーム:</label>
                                <input type="text" value= "{{$jobPostings[0] -> offer2_by_form}}" name="offer2_by_form" readonly>
                            </div>
                            <input type="hidden" name="company_id" value="{{ $jobPostings[0]->company_id}}">
                        </div>
                    </div>

                    <div class="info-button">
                        <button class="registration-button" onclick="validateForm()">削除する</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
@endsection