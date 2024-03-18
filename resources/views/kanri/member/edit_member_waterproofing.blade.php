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
                    <div class="information-content">
                        <div class="box-info">
                            <div class="form-group">
                                <label class="form-label">防水工事募集内容:</label>
                                <div class="checkbox">
                                    <input type="checkbox" name="services[]" value="防水工事" required> 防水工事<br>
                                    <input type="checkbox" name="services[]" value="外壁補修工事各種" required> 外壁補修工事各種<br>
                                    <input type="checkbox" name="services[]" value="シーリング工事" required> シーリング工事<br>
                                    <input type="checkbox" name="services[]" value="雨漏れ補修工事" required> 雨漏れ補修工事<br>
                                    <input type="checkbox" name="services[]" value="止水工事" required> 止水工事<br>
                                    <input type="checkbox" name="services[]" value="調査・診断" required> 調査・診断<br>
                                    <input type="checkbox" name="services[]" value="内装仕上げ工事" required> 内装仕上げ工事<br>
                                    <input type="checkbox" name="services[]" value="その他" required> その他<br>
                                </div>



                            </div>

                            <div class="form-group">
                                <div class="form-label">
                                    <label>防水工事用キャッチ:</label>
                                    <div class="form-attention">
                                        ※文字数〇〇まで
                                    </div>

                                </div>

                                <textarea name="catchphrase" rows="4" cols="50" maxlength="〇〇"
                                    required>〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇</textarea>
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
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="info-button">
                        <button class="registration-button" onclick="validateForm()">更新する</button>
                    </div>


                </div>


            </div>
            <!-- ページネーション -->

        </div>
    </div>

</body>

</html>
@endsection