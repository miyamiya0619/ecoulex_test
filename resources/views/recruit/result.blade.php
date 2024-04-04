@extends('layouts.app')
@section('title', 'CONTACT｜つくりたい未来がある。（一社）エコ・ウレックス工業会')

@section('contact-css')
<link rel="stylesheet" href="{{ asset('css/recruit.css') }}">
@endsection

@section('form-css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
	<!-- main-contents -->
	<div id="main-contents">
			
		<!-- recruit -->
        <section id="recruit" class="result">
			<div class="bg">
				<h2 class="contents"><span class="font-MP">CONTACT</span>
					防水の挑戦者になる
					<p>会員企業の採用情報</p>
				</h2>
			</div>
						
			<div class="searchWrap">
				<div class="fixedWrap">
				<div class="btnArea pc"><p class="contents">地域選択を閉じる</p></div>
				<div class="selectArea areaWrap contents">
					<div class="areaBtn sp">
						<div class="flexbox flexstretch">
							<div class="areaButton area0{{$region_id}}">{{$region_name}}</div>
							<div class="prefButton">
									@if($prefecture_id == 'all')
									{{ $prefectures_sentence }}
									@else
									{{ $prefecture_name[0]->catName }}
									@endif
							</div>
						</div>
					</div>
					
					<div class="areaList flexbox flexbetween">
						<p>北海道</p>
						<p>東北</p>
						<p>北陸・<br class="pc">甲信越</p>
						<a href="{{ route('recruit_search_region', ['region_id' => 4]) }}" class="area04 active">関東</a>
						<a href="{{ route('recruit_search_region', ['region_id' => 5]) }}" class="area05 active">東海</a>
						<p>近畿</p>
						<p>中国</p>
						<p>四国</p>
						<p>九州・<br class="pc">沖縄</p>
					</div><!-- /areaList -->
					@if($region_id ==1)
					<div class="prefList area01 active">
					@else
					<div class="prefList area01">
					@endif
						<a href="result.html"><span>北海道</span></a>
					</div>

					@if($region_id ==2)
					<div class="prefList area02 active">
					@else
					<div class="prefList area02">
					@endif
						<a href="result.html"><span>青森</span></a>
						<a href="result.html"><span>岩手</span></a>
						<a href="result.html"><span>宮城</span></a>
						<a href="result.html"><span>秋田</span></a>
						<a href="result.html"><span>山形</span></a>
						<a href="result.html"><span>福島</span></a>
					</div>

					@if($region_id ==3)
					<div class="prefList area03 active">
					@else
					<div class="prefList area03">
					@endif
						<a href="result.html"><span>新潟</span></a>
						<a href="result.html"><span>富山</span></a>
						<a href="result.html"><span>石川</span></a>
						<a href="result.html"><span>福井</span></a>
						<a href="result.html"><span>長野</span></a>
					</div>

					@if($region_id ==4)
					<div class="prefList area04 active">
					@else
					<div class="prefList area04">
					@endif
					@foreach($prefectures as $index => $prefecture)
						@if($prefecture->region_id == 4)
							@if ($prefecture_id == 'all')
								<a href="{{ route('recruit_search', ['prefecture_id' => $prefecture->prefecuture_id, 'region_id' => 4]) }}" class="active"><span>{{ $prefecture->catName }}</span></a>
							@else
								<a href="{{ route('recruit_search', ['prefecture_id' => $prefecture->prefecuture_id, 'region_id' => 4]) }}" class="@if ($prefecture->prefecuture_id == $prefecture_id) active @endif"><span>{{ $prefecture->catName }}</span></a>
							@endif
						@endif
					@endforeach

					</div>

					@if($region_id ==5)
					<div class="prefList area05 active">
					@else
					<div class="prefList area05">
					@endif
					@foreach($prefectures as $index => $prefecture)
						@if($prefecture->region_id == 5)
							<!-- 静岡のみ初回リリース。 -->
							@if ($prefecture->prefecuture_id == 22)
								@if ($prefecture_id == 'all')
									<a href="{{ route('recruit_search', ['prefecture_id' => $prefecture->prefecuture_id, 'region_id' => 5]) }}" class="active"><span>{{ $prefecture->catName }}</span></a>
								@else
									<a href="{{ route('recruit_search', ['prefecture_id' => $prefecture->prefecuture_id, 'region_id' => 5]) }}" class="@if ($prefecture->prefecuture_id == $prefecture_id) active @endif"><span>{{ $prefecture->catName }}</span></a>
								@endif
							@endif
							<!-- 静岡のみ初回リリース。 -->
						@endif
					@endforeach
					</div>

					@if($region_id ==6)
					<div class="prefList area06 active">
					@else
					<div class="prefList area06">
					@endif
						<a href="result.html"><span>滋賀</span></a>
						<a href="result.html"><span>京都</span></a>
						<a href="result.html"><span>大阪</span></a>
						<a href="result.html"><span>兵庫</span></a>
						<a href="result.html"><span>奈良</span></a>
						<a href="result.html"><span>和歌山</span></a>
					</div>

					@if($region_id ==7)
					<div class="prefList area07 active">
					@else
					<div class="prefList area07">
					@endif
						<a href="result.html"><span>鳥取</span></a>
						<a href="result.html"><span>島根</span></a>
						<a href="result.html"><span>岡山</span></a>
						<a href="result.html"><span>広島</span></a>
						<a href="result.html"><span>山口</span></a>
					</div>

					@if($region_id ==8)
					<div class="prefList area08 active">
					@else
					<div class="prefList area08">
					@endif
						<a href="result.html"><span>徳島</span></a>
						<a href="result.html"><span>香川</span></a>
						<a href="result.html"><span>愛媛</span></a>
						<a href="result.html"><span>高知</span></a>
					</div>

					@if($region_id ==9)
					<div class="prefList area09 active">
					@else
					<div class="prefList area09">
					@endif
						<a href="result.html"><span>福岡</span></a>
						<a href="result.html"><span>佐賀</span></a>
						<a href="result.html"><span>長崎</span></a>
						<a href="result.html"><span>熊本</span></a>
						<a href="result.html"><span>大分</span></a>
						<a href="result.html"><span>宮崎</span></a>
						<a href="result.html"><span>鹿児島</span></a>
						<a href="result.html"><span>沖縄</span></a>
					</div>

				</div><!-- /selectArea -->
				</div>
			</div><!-- /searchWrap -->
<!-- データが存在する場合 -->
@if ($companies->count() != 0)
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
					<div class="Img"><img src="{{ asset('images/uploads/' . $company->prefecuture_image) }}" alt="{{ $company['prefecuture_image']}}"></div>
					<div class="Txt">
						<p class="catch">{{ $company['prefecuture_catch_head']}}</p>
						<p class="detail">{{ $company['prefecuture_catch_reading']}}</p>
					</div>
				</div>
				
				<div class="ttl">勤務条件</div>
				<dl class=" flexbox flexstretch flexstart">
					<dt>勤務地</dt>
					<dd>{{ $company['prefectureNameJo']}} {{ $company['addressDetailJo']}}</dd>
					
					<dt>勤務時間</dt>
					<dd>{{ $company['working_hours']}}</dd>
					
					<dt>初年度月収例</dt>
					<dd>{{ $company['monthly_income']}}</dd>
				</dl>
				
				<div class="ttl">企業情報</div>
				<dl class=" flexbox flexstretch flexstart">
					<dt>WEBサイト</dt>
					<dd><a href="{{ $company['url']}}" target="_blank">{{ $company['url']}}</a></dd>
					
					<dt>所在地</dt>
					<dd>〒{{ $company['address_numCd']}} {{ $company['prefectureNameCd']}} {{ $company['addressDetailCd']}}</dd>
					
					<dt>社員数</dt>
					<dd>{{ $company['number_of_employees']}}</dd>
					
					<dt>設立年</dt>
					<dd>{{ $company['year_of_establishment']}}</dd>
					
					<dt>資本金</dt>
					<dd>{{ $company['capital']}}</dd>
					
					<dt>代表者</dt>
					<dd>{{ $company['representative']}}</dd>
					
					<dt>電話1</dt>
					<dd>{{ $company['offer1_by_tel']}}</dd>
					
					<dt>お問い合わせ先1</dt>
					<!-- 「@」がついている場合はmailtoにする -->
					@if (strpos($company['offer1_by_form'], '@') !== false)
					<dd><a href="mailto:{{ $company['offer1_by_form']}}" target="_blank">{{ $company['offer1_by_form']}}</a></dd>
					@else
					<dd><a href="{{ $company['offer1_by_form']}}" target="_blank">{{ $company['offer1_by_form']}}</a></dd>
					@endif
					<dt>電話2</dt>
					<dd>{{ $company['offer2_by_tel']}}</dd>
					
					<dt>お問い合わせ先2</dt>
					<!-- 「@」がついている場合はmailtoにする -->
					@if (strpos($company['offer2_by_form'], '@') !== false)
					<dd><a href="mailto:{{ $company['offer2_by_form']}}" target="_blank">{{ $company['offer2_by_form']}}</a></dd>
					@else
					<dd><a href="{{ $company['offer2_by_form']}}" target="_blank">{{ $company['offer2_by_form']}}</a></dd>
					@endif
				</dl>

			</div><!-- /resultWrap -->
@endforeach
@else
					<div class="Nodata contents">
							
						<p>該当の企業がありません。お手数ですが、条件を変更して検索してください。</p>
						
					</div><!-- /Nodata -->
@endif
		</section>
	</div><!-- main-contents -->
</div><!-- wrap -->
@endsection

@section('form-js')
<script type="text/javascript" src="{{ asset('js/form.js') }}"></script>
@endsection
@section('searchbox-js')
<script type="text/javascript" src="{{ asset('js/searchbox.js') }}"></script>
@endsection
