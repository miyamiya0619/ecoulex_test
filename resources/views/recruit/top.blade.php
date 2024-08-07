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
        <section id="recruit">
			<div class="bg">
				<h2 class="contents"><span class="font-MP">CONTACT</span>
					防水の挑戦者になる
					<p>会員企業の採用情報</p>
				</h2>

				<h3 class="contents">エコ・ウレックス会員企業の採用情報について検索します。</h3>
			</div>
				
			<div class="selectWrap kanto contents">
				
				<div class="selectArea areaWrap area01 nodata">
					<div class="areaName"><p>北海道</p></div>
					
					<div class="prefArea">
						<p>北海道</p>
					</div>
				</div>
				
				<div class="selectArea areaWrap area02 nodata">
					<div class="areaName"><p>東北</p></div>
					
					<div class="prefArea">
						<p>青森／
						岩手／
						宮城<br>
						秋田／
						山形／
						福島</p>
					</div>
				</div>
				
				<div class="selectArea areaWrap area03 nodata">
					<div class="areaName"><p>北陸・甲信越</p></div>
					
					<div class="prefArea">
						<p>新潟／
						富山／
						石川<br>
						福井／
						長野</p>
					</div>
				</div>
				
				<div class="selectArea areaWrap area04">
				<div class="areaName"><a href="{{ route('recruit_search_region', ['region_id' => 4]) }}">関東</a></div>
					
					<div class="prefArea">
						<a href="{{ route('recruit_search', ['prefecture_id' => 13, 'region_id' => 4]) }}">茨城</a>／
						<a href="{{ route('recruit_search', ['prefecture_id' => 14, 'region_id' => 4]) }}">栃木</a>／
						<a href="{{ route('recruit_search', ['prefecture_id' => 15, 'region_id' => 4]) }}">群馬</a><br>
						<a href="{{ route('recruit_search', ['prefecture_id' => 16, 'region_id' => 4]) }}">埼玉</a>／
						<a href="{{ route('recruit_search', ['prefecture_id' => 17, 'region_id' => 4]) }}">千葉</a>／
						<a href="{{ route('recruit_search', ['prefecture_id' => 18, 'region_id' => 4]) }}">東京</a><br>
						<a href="{{ route('recruit_search', ['prefecture_id' => 19, 'region_id' => 4]) }}">神奈川</a>／
						<a href="{{ route('recruit_search', ['prefecture_id' => 20, 'region_id' => 4]) }}">山梨</a>
					</div>
				</div>
				
				<div class="selectArea areaWrap area05">
					<div class="areaName"><a href="{{ route('recruit_search_region', ['region_id' => 5]) }}">東海</a></div>
					
					<div class="prefArea">
						<p>岐阜／
						<a href="{{ route('recruit_search', ['prefecture_id' => 22, 'region_id' => 5]) }}">静岡</a><br>
						愛知／
						三重</p>
					</div>
				</div>
				
				<div class="selectArea areaWrap area06 nodata">
					<div class="areaName"><p>近畿</p></div>
					
					<div class="prefArea">
						<p>滋賀／
						京都／
						大阪<br>
						兵庫／
						奈良／
						和歌山</p>
					</div>
				</div>
				
				<div class="selectArea areaWrap area07 nodata">
					<div class="areaName"><p>中国</p></div>
					
					<div class="prefArea">
						<p>鳥取／
						島根／
						岡山<br>
						広島／
						山口</p>
					</div>
				</div>
				
				<div class="selectArea areaWrap area08 nodata">
					<div class="areaName"><p>四国</p></div>
					
					<div class="prefArea">
						<p>徳島／
						香川<br>
						愛媛／
						高知</p>
					</div>
				</div>
				
				<div class="selectArea areaWrap area09 nodata">
					<div class="areaName"><p>九州・沖縄</p></div>
					
					<div class="prefArea">
						<p>福岡／
						佐賀／
						長崎<br>
						熊本／
						大分／
						宮崎<br>
						鹿児島／
						沖縄</p>
					</div>
				</div>

			</div>
							
			<div class="buttonArea contents">
			</div>
			
		</section>
		
	</div><!-- main-contents -->
</div><!-- wrap -->
@endsection

@section('form-js')
<script type="text/javascript" src="{{ asset('js/form.js') }}"></script>
@endsection