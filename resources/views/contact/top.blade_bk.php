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
			
			<form action="result.html" method="post">
				
			<div class="selectWrap">
				<h4 class="contents">工事を選択　<span>ご希望する工事の種類を選択してください。</span></h4>
				
				<div class="selectArea selectType contents flexbox flexbetween">
				@foreach($categories as $category)
					<label><input type="checkbox" name="{{ $category->cat_id }}" value="{{ $category->cat_id }}" />{{ $category->cat_name }}</label>
				@endforeach
				</div>

				<h4 class="contents">地域を選択　<span>工事を検討している場所の地域を選んでください。</span></h4>
				
				<div class="selectArea areaWrap contents">
					<div class="areaName"><label class="areaBtn"><input type="checkbox" name="" value="北海道" class="area01" />北海道</label><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexcenter">
							<label><input type="checkbox" name="" value="北海道" class="area01" />北海道</label>
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents">
					<div class="areaName"><label class="areaBtn"><input type="checkbox" name="" value="東北" class="area02" />東北</label><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<label><input type="checkbox" name="" value="青森" class="area02" />青森</label>
							<label><input type="checkbox" name="" value="岩手" class="area02" />岩手</label>
							<label><input type="checkbox" name="" value="宮城" class="area02" />宮城</label>
							<label><input type="checkbox" name="" value="秋田" class="area02" />秋田</label>
							<label><input type="checkbox" name="" value="山形" class="area02" />山形</label>
							<label><input type="checkbox" name="" value="福島" class="area02" />福島</label>
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents">
					<div class="areaName"><label class="areaBtn"><input type="checkbox" name="" value="北陸・甲信越" class="area03" />北陸・甲信越</label><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<label><input type="checkbox" name="" value="新潟" class="area03" />新潟</label>
							<label><input type="checkbox" name="" value="富山" class="area03" />富山</label>
							<label><input type="checkbox" name="" value="石川" class="area03" />石川</label>
							<label><input type="checkbox" name="" value="福井" class="area03" />福井</label>
							<label><input type="checkbox" name="" value="長野" class="area03" />長野</label>
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents">
					<div class="areaName"><label class="areaBtn"><input type="checkbox" name="" value="関東" class="area04" />関東</label><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<label><input type="checkbox" name="" value="茨城" class="area04" />茨城</label>
							<label><input type="checkbox" name="" value="栃木" class="area04" />栃木</label>
							<label><input type="checkbox" name="" value="群馬" class="area04" />群馬</label>
							<label><input type="checkbox" name="" value="埼玉" class="area04" />埼玉</label>
							<label><input type="checkbox" name="" value="千葉" class="area04" />千葉</label>
							<label><input type="checkbox" name="" value="東京" class="area04" />東京</label>
							<label><input type="checkbox" name="" value="神奈川" class="area04" />神奈川</label>
							<label><input type="checkbox" name="" value="山梨" class="area04" />山梨</label>
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents">
					<div class="areaName"><label class="areaBtn"><input type="checkbox" name="" value="東海" class="area05" />東海</label><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<label><input type="checkbox" name="" value="岐阜" class="area05" />岐阜</label>
							<label><input type="checkbox" name="" value="静岡" class="area05" />静岡</label>
							<label><input type="checkbox" name="" value="愛知" class="area05" />愛知</label>
							<label><input type="checkbox" name="" value="三重" class="area05" />三重</label>
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents">
					<div class="areaName"><label class="areaBtn"><input type="checkbox" name="" value="近畿" class="area06" />近畿</label><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<label><input type="checkbox" name="" value="滋賀" class="area06" />滋賀</label>
							<label><input type="checkbox" name="" value="京都" class="area06" />京都</label>
							<label><input type="checkbox" name="" value="大阪" class="area06" />大阪</label>
							<label><input type="checkbox" name="" value="兵庫" class="area06" />兵庫</label>
							<label><input type="checkbox" name="" value="奈良" class="area06" />奈良</label>
							<label><input type="checkbox" name="" value="和歌山" class="area06" />和歌山</label>
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents">
					<div class="areaName"><label class="areaBtn"><input type="checkbox" name="" value="中国" class="area07" />中国</label><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<label><input type="checkbox" name="" value="鳥取" class="area07" />鳥取</label>
							<label><input type="checkbox" name="" value="島根" class="area07" />島根</label>
							<label><input type="checkbox" name="" value="岡山" class="area07" />岡山</label>
							<label><input type="checkbox" name="" value="広島" class="area07" />広島</label>
							<label><input type="checkbox" name="" value="山口" class="area07" />山口</label>
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents">
					<div class="areaName"><label class="areaBtn"><input type="checkbox" name="" value="四国" class="area08" />四国</label><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<label><input type="checkbox" name="" value="徳島" class="area08" />徳島</label>
							<label><input type="checkbox" name="" value="香川" class="area08" />香川</label>
							<label><input type="checkbox" name="" value="愛媛" class="area08" />愛媛</label>
							<label><input type="checkbox" name="" value="高知" class="area08" />高知</label>
						</div>
					</div>
				</div>
				
				<div class="selectArea areaWrap contents">
					<div class="areaName"><label class="areaBtn"><input type="checkbox" name="" value="九州・沖縄" class="area09" />九州・沖縄</label><span></span></div>
					
					<div class="prefArea">
						<div class="flexbox flexstart">
							<label><input type="checkbox" name="" value="福岡" class="area09" />福岡</label>
							<label><input type="checkbox" name="" value="佐賀" class="area09" />佐賀</label>
							<label><input type="checkbox" name="" value="長崎" class="area09" />長崎</label>
							<label><input type="checkbox" name="" value="熊本" class="area09" />熊本</label>
							<label><input type="checkbox" name="" value="大分" class="area09" />大分</label>
							<label><input type="checkbox" name="" value="宮崎" class="area09" />宮崎</label>
							<label><input type="checkbox" name="" value="鹿児島" class="area09" />鹿児島</label>
							<label><input type="checkbox" name="" value="沖縄" class="area09" />沖縄</label>
						</div>
					</div>
				</div>
				
				<div class="buttonArea contents">
					<input type="submit" class="button" value="検索する" />
				</div>
			</div>
			
			</form>
			
		</section>
		
		<footer>
			<div class="footer">
				<div class="flexbox flexbetween flexaligncenter">
					<div class="links flexbox">
						<div><a href="https://www.eco-ulex.com/">エコ・ウレックス工業会</a></div>
						<div><a href="https://www.eco-ulex.com/contact">個人情報の取り扱い</a></div>
					</div>
					
					<div class="copyraight">
						<p>Copyright &copy; eco-ulex. All Rights Reserved.</p>
					</div>
				</div>
			</div>
		</footer>
	
		<a href="#wrap" class="totop"><span></span></a>
		
		<div class="menuBtmWrap">
			<div class="menuBtn flexbox">
				<a href="../contact/" class="flexbox flexaligncenter flexcenter"><img src="../assets/images/common/menu01.png" alt=""><p>防水工事・<br>各種工事の<br>ご相談</p></a>
				<a href="../recruit/" class="flexbox flexaligncenter flexcenter"><img src="../assets/images/common/menu02.png" alt=""><p>防水の<br>挑戦者になる</p></a>
			</div>
		</div>
		
	</div><!-- main-contents -->
</div><!-- wrap -->
@endsection

@section('form-js')
<script type="text/javascript" src="../assets/js/form.js"></script>
@endsection

</body>
</html>
