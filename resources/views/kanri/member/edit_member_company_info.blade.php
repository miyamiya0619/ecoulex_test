@extends('layouts.admin_app')
@section('title', '企業情報管理編集画面')

@section('company_name', $user -> company_name)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/member/common_management.css') }}">
@endsection

@section('content')

        <div class="dashboard-container">
            <div class="information-section">
                <div class="info-header">
                    <h1 class="dashboard-title">企業情報管理</h1>
                </div>
                @include('partials._company_info_header')
                <div class="information-item">
                    <div class="information-content">
                        <div class="box-info">
                            <ul>
                                <li>
                                    <span class="label">URL:</span>
                                    <input type="text" class="URL" value="〇〇〇〇〇〇〇〇〇〇〇〇" required>
                                </li>

                                <li>
                                    <span class="label">郵便番号:</span>
                                    <input type="text" class="zip_code" value="〇〇〇〇〇〇〇〇〇〇〇〇" required>
                                </li>

                                <li>
                                    <span class="label">
                                        都道府県名：
                                    </span>
                                    <select name="prefecture" id="prefecture" required>
                                        <option value="">都道府県を選択してください</option>
                                        <option value="北海道">北海道</option>
                                        <option value="青森県">青森県</option>
                                        <option value="岩手県">岩手県</option>
                                        <option value="宮城県">宮城県</option>
                                        <option value="秋田県">秋田県</option>
                                        <option value="山形県">山形県</option>
                                        <option value="福島県">福島県</option>
                                        <option value="茨城県">茨城県</option>
                                        <option value="栃木県">栃木県</option>
                                        <option value="群馬県">群馬県</option>
                                        <option value="埼玉県">埼玉県</option>
                                        <option value="千葉県">千葉県</option>
                                        <option value="東京都">東京都</option>
                                        <option value="神奈川県">神奈川県</option>
                                        <option value="新潟県">新潟県</option>
                                        <option value="富山県">富山県</option>
                                        <option value="石川県">石川県</option>
                                        <option value="福井県">福井県</option>
                                        <option value="山梨県">山梨県</option>
                                        <option value="長野県">長野県</option>
                                        <option value="岐阜県">岐阜県</option>
                                        <option value="静岡県">静岡県</option>
                                        <option value="愛知県">愛知県</option>
                                        <option value="三重県">三重県</option>
                                        <option value="滋賀県">滋賀県</option>
                                        <option value="京都府">京都府</option>
                                        <option value="大阪府">大阪府</option>
                                        <option value="兵庫県">兵庫県</option>
                                        <option value="奈良県">奈良県</option>
                                        <option value="和歌山県">和歌山県</option>
                                        <option value="鳥取県">鳥取県</option>
                                        <option value="島根県">島根県</option>
                                        <option value="岡山県">岡山県</option>
                                        <option value="広島県">広島県</option>
                                        <option value="山口県">山口県</option>
                                        <option value="徳島県">徳島県</option>
                                        <option value="香川県">香川県</option>
                                        <option value="愛媛県">愛媛県</option>
                                        <option value="高知県">高知県</option>
                                        <option value="福岡県">福岡県</option>
                                        <option value="佐賀県">佐賀県</option>
                                        <option value="長崎県">長崎県</option>
                                        <option value="熊本県">熊本県</option>
                                        <option value="大分県">大分県</option>
                                        <option value="宮崎県">宮崎県</option>
                                        <option value="鹿児島県">鹿児島県</option>
                                        <option value="沖縄県">沖縄県</option>
                                    </select>
                                </li>

                                <li>
                                    <span class="label">所在地:</span>
                                    <input type="text" class="address" value="〇〇〇〇〇〇〇〇〇〇〇〇" required>
                                </li>
                                <li>
                                    <span class="label">社員数:</span>
                                    <input type="text" class="number-of-employees" value="〇〇〇〇〇〇〇〇〇〇〇〇" required>
                                </li>
                                <li>
                                    <span class="label">設立年:</span>
                                    <input type="text" class="establishment-date" value="〇〇〇〇〇〇〇〇〇〇〇〇" required>
                                </li>
                                <li>
                                    <span class="label">資本金:</span>
                                    <input type="text" class="capital" value="〇〇〇〇〇〇〇〇〇〇〇〇" required>
                                </li>
                                <li>
                                    <span class="label">代表者:</span>
                                    <input type="text" class="representative" value="〇〇〇〇〇〇〇〇〇〇〇〇" required>
                                </li>
                                <li>
                                    <span class="label">電話番号:</span>
                                    <input type="text" class="phone-number" value="〇〇〇〇〇〇〇〇〇〇〇〇" required>
                                </li>
                                <li>
                                    <span class="label">フォーム:</span>
                                    <input type="text" class="form-mail" value="〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇" required>
                                </li>
                            </ul>
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