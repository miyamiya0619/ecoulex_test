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
        <section id="contact">
			<div class="bg">
				<h2 class="contents"><span class="font-MP">CONTACT</span>
					防水工事・各種工事<br class="sp">のご相談</h2>

				<h3 class="contents">お気軽にお問い合わせください。</h3>
			</div>
			
			<form action="{{ route('contact_search') }}" method="POST">
				@csrf
			<div class="selectWrap">
				<h4 class="contents">工事を選択　<span>ご希望する工事の種類を選択してください。</span></h4>
				
				<div class="selectArea selectType contents flexbox flexbetween">
					<!-- カテゴリを全件取得し表示 -->
				<!-- @foreach($categories as $category)
					<label><input type="checkbox" name="categories[]" value="{{ $category->cat_id }}" />{{ $category->cat_name }}</label>
				@endforeach -->
				</div>

				<h4 class="contents">地域を選択　<span>工事を検討している場所の地域を選んでください。</span></h4>
				
				<div class="selectArea areaWrap contents">
					<div class="areaName"><label class="areaBtn"><input type="checkbox" name="regions[]" value="4" class="area04" />関東</label><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
						<!-- 関東の地方（region_id = 4） -->
						@foreach($prefetures as $prefeture)
							@if($prefeture->region_id == 4)
							<label><input type="checkbox" name="prefectures[]" value="{{ $prefeture->prefecuture_id }}" class="area0{{ $prefeture->region_id }}" />{{ $prefeture->name }}</label>
							@endif
						@endforeach
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents gray">
					<div class="areaName"><label class="areaBtn"><input type="checkbox" name="" value="北海道" class="area01" />北海道</label><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexcenter">
						<!-- 北海道の地方（region_id = 1） -->
						@foreach($prefetures as $prefeture)
							@if($prefeture->region_id == 1)
							<label><input type="checkbox" name="" value="{{ $prefeture->prefecuture_id }}" class="area0{{ $prefeture->region_id }}" />{{ $prefeture->name }}</label>
							@endif
						@endforeach
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents">
					<div class="areaName"><label class="areaBtn"><input type="checkbox" name="regions[]" value="東北" class="area02" />東北</label><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<!-- 東北の地方（region_id = 2） -->
						@foreach($prefetures as $prefeture)
							@if($prefeture->region_id == 2)
							<label><input type="checkbox" name="prefectures[]" value="{{ $prefeture->prefecuture_id }}" class="area0{{ $prefeture->region_id }}" />{{ $prefeture->name }}</label>
							@endif
						@endforeach
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents gray">
					<div class="areaName"><label class="areaBtn"><input type="checkbox" name="" value="北陸・甲信越" class="area03" />北陸・甲信越</label><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<!-- 北陸・甲信越の地方（region_id = 3） -->
						@foreach($prefetures as $prefeture)
							@if($prefeture->region_id == 3)
							<label><input type="checkbox" name="" value="{{ $prefeture->prefecuture_id }}" class="area0{{ $prefeture->region_id }}" />{{ $prefeture->name }}</label>
							@endif
						@endforeach
						</div>
					</div>
				</div>
				
				
				
				<div class="selectArea areaWrap contents gray">
					<div class="areaName"><label class="areaBtn"><input type="checkbox" name="" value="東海" class="area05" />東海</label><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<!-- 東海の地方（region_id = 5） -->
						@foreach($prefetures as $prefeture)
							@if($prefeture->region_id == 5)
							<label><input type="checkbox" name="" value="{{ $prefeture->prefecuture_id }}" class="area0{{ $prefeture->region_id }}" />{{ $prefeture->name }}</label>
							@endif
						@endforeach
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents gray">
					<div class="areaName"><label class="areaBtn"><input type="checkbox" name="" value="近畿" class="area06" />近畿</label><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<!-- 近畿の地方（region_id = 6） -->
						@foreach($prefetures as $prefeture)
							@if($prefeture->region_id == 6)
							<label><input type="checkbox" name="" value="{{ $prefeture->prefecuture_id }}" class="area0{{ $prefeture->region_id }}" />{{ $prefeture->name }}</label>
							@endif
						@endforeach
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents gray">
					<div class="areaName"><label class="areaBtn"><input type="checkbox" name="" value="中国" class="area07" />中国</label><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<!-- 中国の地方（region_id = 7） -->
						@foreach($prefetures as $prefeture)
							@if($prefeture->region_id == 7)
							<label><input type="checkbox" name="" value="{{ $prefeture->prefecuture_id }}" class="area0{{ $prefeture->region_id }}" />{{ $prefeture->name }}</label>
							@endif
						@endforeach
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents gray">
					<div class="areaName"><label class="areaBtn"><input type="checkbox" name="" value="四国" class="area08" />四国</label><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<!-- 四国の地方（region_id = 8） -->
						@foreach($prefetures as $prefeture)
							@if($prefeture->region_id == 8)
							<label><input type="checkbox" name="" value="{{ $prefeture->prefecuture_id }}" class="area0{{ $prefeture->region_id }}" />{{ $prefeture->name }}</label>
							@endif
						@endforeach
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents gray">
					<div class="areaName"><label class="areaBtn"><input type="checkbox" name="" value="九州・沖縄" class="area09" />九州・沖縄</label><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<!-- 九州・沖縄の地方（region_id = 9） -->
						@foreach($prefetures as $prefeture)
							@if($prefeture->region_id == 9)
							<label><input type="checkbox" name="" value="{{ $prefeture->prefecuture_id }}" class="area0{{ $prefeture->region_id }}" />{{ $prefeture->name }}</label>
							@endif
						@endforeach
						</div>
					</div>
				</div>
				
				<div class="buttonArea contents">
					<input type="submit" class="button" value="検索する" />
				</div>
			</div>
			
			</form>
			
		</section>
		
	</div><!-- main-contents -->
</div><!-- wrap -->
@endsection

@section('form-js')
<script type="text/javascript" src="{{ asset('js/form.js') }}"></script>
@endsection


</body>
</html>
