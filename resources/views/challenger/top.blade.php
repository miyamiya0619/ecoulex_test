@extends('layouts.app')
@section('title', 'CHALLENGER｜つくりたい未来がある。（一社）エコ・ウレックス工業会')

@section('future-css')
<link rel="stylesheet" href="{{ asset('css/challenger.css') }}">
@endsection
    
@section('content')
	<!-- main-contents -->
	<div id="main-contents">
				
		<!-- challenger -->
        <section id="challenger">
			<div class="bg">
				<h2 class="contents"><span class="font-MP">CHALLENGER</span>
					防水の挑戦者たち</h2>

				<h3 class="contents">人ため、社会のため、そして、自分の夢のために今日も真剣勝負！ <br>
					あなたの暮らしを守る私たちが防水のエキスパートです。</h3>
			</div>
			
			<!-- movie -->
			<div class="movieArea">
				<div class="movieWrap contents">
					<div class="movie"><iframe width="560" height="315" src="https://www.youtube.com/embed/MnIqUgqz2Ao" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></div>
				</div>

				<div class="Ttl contents">挑戦者たち</div>
			</div>
			
			<div class="chArea">
				<div class="photo contents"><img src="{{ asset('images/challenger/challenger01.jpg') }}" alt=""></div>
				<div class="profile contents flexbox flexaligncenter flexstart">
					<div class="Ttl">CHALLENGER</div>
					<div class="Txt contents flexbox flexaligncenter flexstart">
						<div class="no">01</div>
						<div class="nameArea">
							<p class="name">山本 茉莉</p>
							<p>株式会社誠真工業／事務職／2020年入社</p>
						</div>
						<div class="text">
							<p>アパレル業界から結婚・出産を経て、防水業界に転職。<br>
								施工担当者のサポート。工程の写真作成や工事発注、図面の作成、精算など。<br>
								大好きな“ものづくり“を仕事に生かせることが今のやりがい。<br>
								夢は自分の住みたい家を設計すること。<br><br>
								<span class="strong">挑戦者にひとこと</span><br>
								好きなこと　自分が得意とすることを見つけて　自分の力にして　挑戦してほしい<br><br>
								<span class="strong">防水の仕事を通してひとこと</span><br>
								より良い住まいづくりをサポートして安心に暮らせる街づくり。
							</p>
						</div>
					</div>
				</div>
				
				<div class="Box">
					<div class="BoxTtl c01 contents">山本 茉莉の挑戦</div>
					<dl class="flexbox flexaligncenter flexstart">
						<dt class="first contents next"><p>1年目</p></dt>
						<dd class="contents">工事発注、請求書の処理、工程写真の記録など<br class="pc">
							事務作業全般を把握し施工が円滑に行えるようサポート。</dd>
						
						<dt class="contents future"><p>4年目<span>–今後の挑戦–</span></p></dt>
						<dd class="contents">施工全体を把握し、迅速な対応が取れるようになる。<br>
							新しいスタッフの教育も行う。</dd>
						
						<dt class="contents future last"><p>10年目<span>–今後の挑戦–</span></p></dt>
						<dd class="contents">会社業務改善や個人のスキルアップなど率先して<br class="pc">新しい提案をし、遂行できるようになることが目標。</dd>
					</dl>
				</div>
			</div>
			
			<div class="chArea">
				<div class="photo contents"><img src="{{ asset('images/challenger/challenger02.jpg') }}" alt=""></div>
				<div class="profile contents flexbox flexaligncenter flexstart">
					<div class="Ttl">CHALLENGER</div>
					<div class="Txt contents flexbox flexaligncenter flexstart">
						<div class="no">02</div>
						<div class="nameArea">
							<p class="name">山口 拓也</p>
							<p>株式会社Tプルーフ／工事部職長／2017年入社</p>
						</div>
						<div class="text">
							<p>専門学校卒業後、自動車整備士を5年経験し、防水業界へ。<br>
								主に現場での防水工事　指示管理を担当。<br>
								仕事のやりがいは、仕上がりや対応をお客様に満足いただけた時。<br>
								夢は海外を旅すること。<br><br>
								<span class="strong">挑戦者にひとこと</span><br>
								何でも挑戦してみるのがいい。失敗を恐れずに！<br><br>
								<span class="strong">防水の仕事を通してひとこと</span><br>
								安心して暮らせる　生活できる環境を提供していきたい。</p>
						</div>
					</div>
				</div>
				
				<div class="Box">
					<div class="BoxTtl c02 contents">山口 拓也の挑戦</div>
					<dl class="flexbox flexaligncenter flexstart">
						<dt class="first contents"><p>1年目</p></dt>
						<dd class="contents">現場の職人として作業のノウハウを学ぶ。</dd>
						
						<dt class="contents"><p>3年目</p></dt>
						<dd class="contents">1人で現場を納められるようになり、<br class="pc">
							職人としての経験も十分積む。</dd>
						
						<dt class="contents next"><p>5年目</p></dt>
						<dd class="contents">班長や職長として現場管理を行い、<br class="pc">
							指揮官として作業員を取りまとめる。</dd>
						
						<dt class="contents future last"><p>10年目<span>–今後の挑戦–</span></p></dt>
						<dd class="contents">受注から施工までを一人で進行できるようになり、<br class="pc">
							自分の顧客を持つことが目標。</dd>
					</dl>
				</div>
			</div>

		</section>
	</div><!-- main-contents -->
</div><!-- wrap -->
@endsection
