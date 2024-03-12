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
							<div class="areaButton area04">関東</div>
							<div class="prefButton">東京</div>
						</div>
					</div>
					
					<div class="areaList flexbox flexbetween">
						<p>北海道</p>
						<p>東北</p>
						<p>北陸・<br class="pc">甲信越</p>
						<a href="result.html" class="area04 active">関東</a>
						<p>東海</p>
						<p>近畿</p>
						<p>中国</p>
						<p>四国</p>
						<p>九州・<br class="pc">沖縄</p>
					</div><!-- /areaList -->

					<div class="prefList area01">
						<a href="result.html"><span>北海道</span></a>
					</div>

					<div class="prefList area02">
						<a href="result.html"><span>青森</span></a>
						<a href="result.html"><span>岩手</span></a>
						<a href="result.html"><span>宮城</span></a>
						<a href="result.html"><span>秋田</span></a>
						<a href="result.html"><span>山形</span></a>
						<a href="result.html"><span>福島</span></a>
					</div>

					<div class="prefList area03">
						<a href="result.html"><span>新潟</span></a>
						<a href="result.html"><span>富山</span></a>
						<a href="result.html"><span>石川</span></a>
						<a href="result.html"><span>福井</span></a>
						<a href="result.html"><span>長野</span></a>
					</div>

					<div class="prefList area04 active">
					@foreach($prefectures as $index => $prefecture)
						@if($prefecture->region_id == 4)
							<a href="{{ route('recruit_search', ['prefecture_id' => $prefecture_id]) }}" @if ($prefecture->prefecuture_id == $prefecture_id) class="active" @endif><span>{{ $prefecture->catName }}</span></a>
						@endif
					@endforeach
					</div>

					<div class="prefList area05">
						<a href="result.html"><span>岐阜</span></a>
						<a href="result.html"><span>静岡</span></a>
						<a href="result.html"><span>愛知</span></a>
						<a href="result.html"><span>三重</span></a>
					</div>

					<div class="prefList area06">
						<a href="result.html"><span>滋賀</span></a>
						<a href="result.html"><span>京都</span></a>
						<a href="result.html"><span>大阪</span></a>
						<a href="result.html"><span>兵庫</span></a>
						<a href="result.html"><span>奈良</span></a>
						<a href="result.html"><span>和歌山</span></a>
					</div>

					<div class="prefList area07">
						<a href="result.html"><span>鳥取</span></a>
						<a href="result.html"><span>島根</span></a>
						<a href="result.html"><span>岡山</span></a>
						<a href="result.html"><span>広島</span></a>
						<a href="result.html"><span>山口</span></a>
					</div>

					<div class="prefList area08">
						<a href="result.html"><span>徳島</span></a>
						<a href="result.html"><span>香川</span></a>
						<a href="result.html"><span>愛媛</span></a>
						<a href="result.html"><span>高知</span></a>
					</div>

					<div class="prefList area09">
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
					<div class="Img"><img src="{{ asset('images/uploads/' . $company->waterproofing_job_image) }}" alt="株式会社xxxx"></div>
					<div class="Txt">
						<p class="catch">キャッチが入ります。キャッチが入ります。</p>
						<p class="detail">会社紹介が入ります。会社紹介が入ります。会社紹介が入ります。<br>会社紹介が入ります。会社紹介が入ります。<br>会社紹介が入ります。会社紹介が入ります。会社紹介が入ります。</p>
					</div>
				</div>
				
				<div class="ttl">勤務条件</div>
				<dl class=" flexbox flexstretch flexstart">
					<dt>勤務地</dt>
					<dd>東京都港区赤坂</dd>
					
					<dt>勤務時間</dt>
					<dd>8:00~18:00（休憩２時間）</dd>
					
					<dt>初年度月収例</dt>
					<dd>月20万</dd>
				</dl>
				
				<div class="ttl">企業情報</div>
				<dl class=" flexbox flexstretch flexstart">
					<dt>WEBサイト</dt>
					<dd><a href="https://tfc.co.jp/" target="_blank">https://tfc.co.jp/</a></dd>
					
					<dt>所在地</dt>
					<dd>〒107-0052東京都港区赤坂4-9-17 <br>赤坂第一ビル７F</dd>
					
					<dt>社員数</dt>
					<dd>1000人（2023年3月時点）</dd>
					
					<dt>設立年</dt>
					<dd>1961年</dd>
					
					<dt>資本金</dt>
					<dd>1億円</dd>
					
					<dt>代表者</dt>
					<dd>小坂恵一</dd>
					
					<dt>電話</dt>
					<dd>03-1111-1111<br>（平日9：00-17：00）</dd>
					
					<dt>お問い合わせ先</dt>
					<dd><a href="https://tfc.co.jp/contact/" target="_blank">https://tfc.co.jp/contact/</a></dd>
				</dl>

			</div><!-- /resultWrap -->
@endforeach

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

</body>
</html>
