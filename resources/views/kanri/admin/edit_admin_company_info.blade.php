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
                    <h1 class="dashboard-title">会員企業管理</h1>
                </div>
                <div class="information-item">
                <form action="{{route('ecoulex.kanri.updateEditAdminCompanyInfo')}}" method="post" novalidate>
                @csrf <!-- CSRFトークンを含める -->
                    <div class="information-content">
                        <div class="box-info">
                        @if(isset($status) && $status != "")
                            <p class="message"> {{ $status }}</p>
                        @endif
                        @if(isset($errors) && !empty($errors))
                                @foreach ($errors as $field => $messages)
                                    @if(is_array($messages))
                                        @foreach ($messages as $message)
                                        <p class="message">{{ $message }}</p>
                                        @endforeach
                                    @else
                                    <p class="message">{{ $messages }}</p>
                                    @endif
                                @endforeach
                        @endif
                            <ul>
                                <li>
                                    <span class="label">企業名:</span>
                                    <input type="text" class="company_name" name="company_name" value="{{ $companies[0]->company_name}}"  maxlength="50" required>
                                </li>

                                <li>
                                    <span class="label">企業名カナ:</span>
                                    <input type="text" class="company_name_kana" name="company_name_kana" value="{{ $companies[0]->company_name_kana}}" maxlength="50">
                                </li>
                                <li>
                                    <span class="label">編集担当<br>メールアドレス1:</span>
                                    <input type="text" class="email" name="email" value="{{ $companies[0]->email }}" maxlength="50" required>
                                </li>
                                <li>
                                    <span class="label">編集担当<br>メールアドレス2:</span>
                                    <input type="text" class="email2" name="email2" value="{{ $companies[0]->email2 }}" maxlength="50">
                                </li>
                                <li>
                                    <span class="label">編集担当<br>メールアドレス3:</span>
                                    <input type="text" class="email3" name="email3" value="{{ $companies[0]->email3 }}" maxlength="50">
                                </li>
                            </ul>
                            <input type="hidden" name="company_id" value="{{ $companies[0]->company_id}}">
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