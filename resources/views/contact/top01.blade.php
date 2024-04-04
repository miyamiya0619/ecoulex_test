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

				<h3 class="contents">お気軽にお問い合わせください。<br>
				<div class="alert alert-danger">
					<ul>
						@if ($errors->any())
							@foreach ($errors->all() as $error)
								<li class="error-message">{{ $error }}</li>
							@endforeach
						@endif
					</ul>
				</div>
			</h3>
			</div>
			<form action="{{ route('contact_search') }}" method="POST">
				@csrf
			<div class="selectWrap">
				<h4 class="contents">工事を選択　<span>ご希望する工事の種類を選択してください。<br>
			<small class="contents_caution">防水工事の種類がわからない方は調査、診断|防水劣化調査、診断を選択してください</small></h4>
				
				<div class="selectArea selectType contents flexbox flexbetween">
					<!-- カテゴリを全件取得し表示 -->
					@foreach($categories as $index => $category)
						<label class="areaBtn_font">
							<input type="checkbox" name="categories[]" value="{{ $category->waterproofcat_id }}" {{ in_array($category->waterproofcat_id, $categoryIds ?? []) ? 'checked' : '' }}/>{{ $category->catName }}
						</label>
					@endforeach
				</div>

				<h4 class="contents">地域を選択　<span>工事を検討している場所の地域を選んでください。</span></h4>
				
				<div class="selectArea areaWrap contents">
					<div class="areaName"><div class="areaBtn">関東</div><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
						<!-- 関東の地方（region_id = 4） -->
						@foreach($prefectures as $index => $prefecture)
							@if($prefecture->region_id == 4)
							<label><input type="checkbox" name="prefectures[]" value="{{ $prefecture->prefecuture_id }}" class="area0{{ $prefecture->region_id }}" {{ in_array($prefecture->prefecuture_id, $prefectureIds ?? []) ? 'checked' : '' }}/>{{ $prefecture->catName }}</label>
							@endif
						@endforeach
						</div>
					</div>
				</div>

				<div class="selectArea areaWrap contents">
					<div class="areaName"><div class="areaBtn">東海</div><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<!-- 東海の地方（region_id = 5） -->
						@foreach($prefectures as $prefecture)
							@if($prefecture->region_id == 5)
								<!-- 暫定対応（静岡のみ初回リリースのためそれ以外の県は非表示） -->
								@if($prefecture->prefecuture_id == 22)
								<label><input type="checkbox" name="prefectures[]" value="{{ $prefecture->prefecuture_id }}" class="area0{{ $prefecture->region_id }}" {{ in_array($prefecture->prefecuture_id, $prefectureIds ?? []) ? 'checked' : '' }}/>{{ $prefecture->catName }}</label>
								@endif
							@endif
						@endforeach
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents gray">
					<div class="areaName"><div class="areaBtn">北海道</div><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexcenter">
						<!-- 北海道の地方（region_id = 1） -->
						@foreach($prefectures as $prefecture)
							@if($prefecture->region_id == 1)
								<label><input type="checkbox" name="" value="{{ $prefecture->prefecuture_id }}" class="area0{{ $prefecture->region_id }}" {{ in_array($prefecture->prefecuture_id, $prefectureIds ?? []) ? 'checked' : '' }} />{{ $prefecture->catName }}</label>
							@endif
						@endforeach
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents gray">
					<div class="areaName"><div class="areaBtn">東北</div><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<!-- 東北の地方（region_id = 2） -->
						@foreach($prefectures as $prefecture)
							@if($prefecture->region_id == 2)					
								<label><input type="checkbox" name="prefectures[]" value="{{ $prefecture->prefecuture_id }}" class="area0{{ $prefecture->region_id }}" {{ in_array($prefecture->prefecuture_id, $prefectureIds ?? []) ? 'checked' : '' }} />{{ $prefecture->catName }}</label>
							@endif
						@endforeach
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents gray">
					<div class="areaName"><div class="areaBtn">北陸・甲信越</div><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<!-- 北陸・甲信越の地方（region_id = 3） -->
						@foreach($prefectures as $prefecture)
							@if($prefecture->region_id == 3)
								<label><input type="checkbox" name="" value="{{ $prefecture->prefecuture_id }}" class="area0{{ $prefecture->region_id }}" {{ in_array($prefecture->prefecuture_id, $prefectureIds ?? []) ? 'checked' : '' }}/>{{ $prefecture->catName }}</label>
							@endif
						@endforeach
						</div>
					</div>
				</div>
				
				
				<div class="selectArea areaWrap contents gray">
					<div class="areaName"><div class="areaBtn">近畿</div><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<!-- 近畿の地方（region_id = 6） -->
						@foreach($prefectures as $prefecture)
							@if($prefecture->region_id == 6)
								<label><input type="checkbox" name="" value="{{ $prefecture->prefecuture_id }}" class="area0{{ $prefecture->region_id }}" {{ in_array($prefecture->prefecuture_id, $prefectureIds ?? []) ? 'checked' : '' }}/>{{ $prefecture->catName }}</label>
							@endif
						@endforeach
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents gray">
					<div class="areaName"><div class="areaBtn">中国</div><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<!-- 中国の地方（region_id = 7） -->
						@foreach($prefectures as $prefecture)
							@if($prefecture->region_id == 7)
								<label><input type="checkbox" name="" value="{{ $prefecture->prefecuture_id }}" class="area0{{ $prefecture->region_id }}" {{ in_array($prefecture->prefecuture_id, $prefectureIds ?? []) ? 'checked' : '' }}/>{{ $prefecture->catName }}</label>
							@endif
						@endforeach
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents gray">
					<div class="areaName"><div class="areaBtn">四国</div><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<!-- 四国の地方（region_id = 8） -->
						@foreach($prefectures as $prefecture)
							@if($prefecture->region_id == 8)
								<label><input type="checkbox" name="" value="{{ $prefecture->prefecuture_id }}" class="area0{{ $prefecture->region_id }}"  {{ in_array($prefecture->prefecuture_id, $prefectureIds ?? []) ? 'checked' : '' }} />{{ $prefecture->catName }}</label>
							@endif
						@endforeach
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents gray">
					<div class="areaName"><div class="areaBtn">九州・沖縄</div><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<!-- 九州・沖縄の地方（region_id = 9） -->
						@foreach($prefectures as $prefecture)
							@if($prefecture->region_id == 9)
								<label><input type="checkbox" name="" value="{{ $prefecture->prefecuture_id }}" class="area0{{ $prefecture->region_id }}" {{ in_array($prefecture->prefecuture_id, $prefectureIds ?? []) ? 'checked' : '' }} />{{ $prefecture->catName }}</label>
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