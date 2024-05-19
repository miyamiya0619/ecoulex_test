@extends('layouts.admin_app')

@section('title', '防水情報管理')

@section('company_name', $user -> company_name)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/admin_dashboard.css') }}">
@endsection

@section('content')
        <div class="dashboard-container">
            <div class="information-section">
            <form  action="{{route('ecoulex.kanri.waterProofingSearch')}}" method="post" novalidate>
                <div class="info-header_com">
                    <h1 class="dashboard-title">防水情報管理</h1>
                    <div class="search_group">
                        <div></div>
                        <div class="search-container search-container">
                            <input type="text" name="search_freeword" placeholder="検索" value="{{ $search_freeword ?? '' }}">
                            <button class="search-button">検索</button>
                        </div>
                    </div>
                </div>
                @csrf <!-- CSRFトークンを含める -->
                @if(isset($status) && $status != "")
                    <p class="message"> {{ $status }}</p>
                @endif
                @if ($waterproofs->isEmpty())
                    <div class="information-box">検索対象の求人は存在しません。</div>
                @else
                <div class="information-box">
                    @foreach($waterproofs as $waterproof)
                        <div class="information-item">
                            <div class="information-content">
                            <div class="waterProofing_txt">
                                <div class="waterproof-name">{{$waterproof -> company_name}}</div>
                                <div class="waterproof-updatetime"><span class="strong">情報更新日：</span>{{$waterproof -> updated_at}}</div>
                            </div>
                            </div>
                            <!-- 削除 -->
                            <div class="button_group">
                                <div class="info-button">
                                    <a href="{{route('ecoulex.kanri.editAdminWaterProofInfo', ['company_id' => $waterproof->company_id ])}}" class="info-button">編集</a>
                                </div>
                                <div class="info-button" class="info-button">
                                    <a href="{{route('ecoulex.kanri.deleditAdminWaterProofInfo', ['company_id' => $waterproof->company_id ])}}" class="info-button">削除</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </form>
            </div>
            <!-- ページネーション -->

        </div>
 
 @endsection