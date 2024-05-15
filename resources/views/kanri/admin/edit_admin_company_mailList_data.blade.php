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
                <p>企業担当メールアドレス一覧（編集）</p>
                <div class="information-item">
                <form action="{{route('ecoulex.kanri.updateEditlistmailaddressdetail')}}" method="post" novalidate>
                @csrf <!-- CSRFトークンを含める -->
                    <div class="information-content">
                        <div class="box-info">
                        @if(isset($status) && $status != "")
                        <p class="message"> {{ $status }}</p>
                        @endif
                            <ul>
                                
                                <li>
                                    <span class="label">企業名:</span>
                                    <p>{{ $mailList[0]->company_name}}</p>
                                </li>
                                <li>
                                    <span class="label">メールアドレス:</span>
                                    <input type="text" class="email" name="email" value="{{ $mailList[0]->email}}">
                                </li>

                            </ul>
                            <input type="hidden" name="company_id" value="{{ $mailList[0]->company_id}}">
                            <input type="hidden" name="m_id" value="{{ $m_id }}">
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