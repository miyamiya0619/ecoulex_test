@extends('layouts.app')
@section('title', 'CONTACT｜つくりたい未来がある。（一社）エコ・ウレックス工業会')

@section('contact-css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('form-css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')

	<!-- main-contents -->
	<div id="main-contents">
			
		<!-- contact -->
        <section id="contact" class="result">
			<div class="bg">
				<h2 class="contents"><span class="font-MP">CONTACT</span>
					防水工事・各種工事<br class="sp">のご相談</h2>
			</div>
			
			<div class="searchBox contents flexbox flexbetween">
				<div class="searchData">
					
					<div class="searchList flexbox flexstart">
						<div class="ttl">工事：</div>
						<ul class="searchList flexbox flexaligncenter flexstart">
						@foreach($categories as $waterproofcat_id => $catName)
							<li class="searchType">{{ $catName }}</li>
						@endforeach
						</ul>
					</div>

					<div class="searchArea flexbox flexstart">
						<div class="ttl">地域：</div>
						<ul class="searchList flexbox flexaligncenter flexstart">
						@foreach($groupedPrefectures as $groupedPrefecture)
							<li class="searchType">
								{{ $groupedPrefecture['regionName'] }}｜
								<?php $prefectureNames = $groupedPrefecture['prefectures']->pluck('prefecture_name')->implode('、 '); ?>
								{{ $prefectureNames }}
							</li>
						@endforeach

						</ul>
					</div>
					
				</div><!-- /searchData -->
				
				@if ($companies->total() != 0)		
				<div class="searchButton">
					<a href="/ecoulex/contact/?checkflg=1">条件を変更する</a>
				</div>
				@endif
			</div><!-- /searchBox -->
<!-- データが存在する場合 -->
@if ($companies->total() != 0)				
			@foreach($companies as $company)
			<div class="resultWrap contents">
				<div class="Name">{{ $company['company_name']}}</div>
				
				<div class="searchList flexbox flexstretch flexstart">
				@if (!is_null($company->catNames))
					@php
						$catNamesArray = explode(',', str_replace(['[', ']'], '', $company->catNames));
					@endphp

					@foreach($catNamesArray as $catName)
						<div class="searchType">{{ $catName }}</div>
					@endforeach
				@endif
				</div>

				<div class="Company flexbox flexbetween">
					<div class="Img">
					@if ($company->waterproofing_job_image && file_exists(public_path('images/uploads/' . $company->waterproofing_job_image)))
						<img src="{{ asset('images/uploads/' . $company->waterproofing_job_image) }}" alt="{{ $company->company_name }}">
					@else
					@endif
					</div>
					<div class="Txt">
						<p class="catch">{{ $company['waterproofing_job_description']}}</p>
						<p class="detail">{{ $company['waterproofing_job_catch']}}</p>
					</div>
				</div>
				
				<div class="ttl">企業情報</div>
				<dl class=" flexbox flexstretch flexstart">
					<dt>WEBサイト</dt>
					<dd><a href="{{ $company['url']}}" target="_blank">{{ $company['url']}}</a></dd>
					
					<dt>所在地</dt>
					<dd>〒{{ $company['address_num']}} {{ $company['prefectureName']}} {{ $company['addressDetail']}}</dd>
					
					<dt>代表者</dt>
					<dd>{{ $company['representative']}}</dd>
					
					<dt>電話</dt>
					<dd>{{ $company['phone']}}</dd>
					
					<dt>お問い合わせ先</dt>
					<dd><a href="{{ $company['form']}}" target="_blank">{{ $company['form']}}</a></dd>
				</dl>

			</div><!-- /resultWrap -->
			@endforeach

			<div class="resultNav contents">
				<ul class="flexbox flexcenter flexaligncenter">
					<!-- Previous Button -->
					@if ($companies->currentPage() == 1)
						
					@else
						<li class="prevBtn"><a href="{{ $companies->url($companies->currentPage() - 1) }}"></a></li>
					@endif

					<!-- Page Numbers -->
					@for ($i = 1; $i <= $companies->lastPage(); $i++)
						@if ($i == $companies->currentPage())
							<li class="active"><span>{{ $i }}</span></li>
						@else
							<li><a href="{{ $companies->url($i) }}">{{ $i }}</a></li>
						@endif
					@endfor

					<!-- Next Button -->
					@if ($companies->currentPage() == $companies->lastPage())
						
					@else
						<li class="nextBtn"><a href="{{ $companies->url($companies->currentPage() + 1) }}"></a></li>
					@endif
				</ul>
			</div><!-- /resultNav -->
@else

			<div class="Nodata contents">
							
				<p>該当の企業がありません。お手数ですが、条件を変更して検索してください。</p>
				
				<div class="searchButton">
					<a href="/ecoulex/contact/?checkflg=1" class="button">条件を変更する</a>
				</div>
			</div><!-- /Nodata -->			
@endif
		</section>
	
	
		<a href="#wrap" class="totop"><span></span></a>
		
		
	</div><!-- main-contents -->
</div><!-- wrap -->
    	
@endsection

@section('form-js')
<script type="text/javascript" src="{{ asset('js/form.js') }}"></script>
@endsection