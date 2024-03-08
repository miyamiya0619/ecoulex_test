@extends('layouts.app')
@section('title', 'つくりたい未来がある。（一社）エコ・ウレックス工業会')

@section('slick-css')
<link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('css/slick.css') }}">
@endsection

@section('content')
	<!-- main-contents -->
	<div id="main-contents">
		
		<!-- header -->
		<header>
			<div id="keyvisual"></div>
			<div class="catch"><img src="{{ asset('images/index/catch.svg') }}" alt="常識を捨てて、歩こう。"></div>
			<div class="scroll"><p class="font-MP">SCROLL</p><span></span></div>
		</header>
		
		<!-- lead -->
        <section id="lead">
			
			<p>
				<picture>
					<source srcset="{{ asset('images/index/lead.png') }}" media="(min-width: 640px)" />
					<img src="{{ asset('images/index/lead_sp.png') }}" alt="入学式。 運動会。 結婚式。なぜか、私の大事な日にはいつも雨が降る。その度に家族と、友達と、彼と、傘を持って歩いた。皮肉な自然の巡り合せに、苦笑いを交わしながら。わたしたちは、自然が問いかける「まさか」に、ときに迷いながら生きている。明日の結婚記念日も、雨予報。母が笑う。私も笑う。わたしに必要なのは、あなたとの毎日です。　つくりたい未来がある。エコ・ウレックス工業会">
				</picture>
			</p>
			
			<div class="buttonArea contents"><a href="message/" class="button widthAuto">エコ・ウレックス工業会 会長より</a></div>
		</section>
		
		<!-- news -->
        <section id="news">
			<h2 class="contents">新着情報</h2>
			
			<ul class="contents">
				<li class=" flexbox flexcenter"><p class="date">2024.04.01</p><p class="txt">防水の挑戦者募集開始いたしました。</p></li>
				<li class=" flexbox flexcenter"><p class="date">2024.04.01</p><p class="txt">Instagram開始しました。</p></li>
				<li class=" flexbox flexcenter"><p class="date">2024.04.01</p><p class="txt">防水の挑戦者募集開始いたしました。</p></li>
			</ul>

		</section>

		<!-- future -->
        <section id="future">
			<div class="rellax droprR first" data-rellax-speed="4" data-rellax-percentage="0.2"><div></div></div>
			<div class="rellax droprL dropS" data-rellax-speed="5" data-rellax-percentage="0"><div></div></div>
			
			<h2 class="contents"><span class="font-MP">FUTURE</span>
				これからの防水</h2>
			
			<ul class="flexbox flexaligncenter flexcenter">
				<li class="contents"><div><a href="future/#cont01" class="flexbox flexaligncenter flexbetween"><img src="{{ asset('images/future/future01.png') }}" alt=""><span>進化</span></a></div></li>
				<li class="contents"><div><a href="future/#cont02" class="flexbox flexaligncenter flexbetween"><img src="{{ asset('images/future/future02.png') }}" alt=""><span>デザイン</span></a></div></li>
				<li class="contents"><div><a href="future/#cont03" class="flexbox flexaligncenter flexbetween"><img src="{{ asset('images/future/future03.png') }}" alt=""><span>生み出す</span></a></div></li>
			</ul>
			
			<div class="buttonArea contents"><a href="future/" class="button">すべて見る</a></div>
        </section>
		
		<!-- challenger -->
		<section id="challenger">
			<div class="rellax droprR2" data-rellax-speed="4" data-rellax-percentage="0.2"><div></div></div>
			
			<h2 class="contents"><span class="font-MP">CHALLENGER</span>
				防水の挑戦者たち</h2>
			
			<div class="chWrap flexbox flexaligncenter flexbetween">
				<div class="ch_Image contents"><img src="{{ asset('images/challenger/top_challenger.png') }}" alt=""></div>
				<div class="ch_Txt contents"><p>人のため、社会のため、そして、<br class="pc">自分の夢のために今日も真剣勝負！ <br>
					あなたの暮らしを守る私たちが防水の<br class="pc">エキスパートです。</p></div>
			</div>
            
			<div class="buttonArea contents"><a href="challenger/" class="button">インタビューを見る</a></div>
		</section>
		
		<!-- case -->
        <section id="case">
			<div class="rellax droprL2" data-rellax-speed="5" data-rellax-percentage="0.5"><div></div></div>
			
			<h2 class="contents"><span class="font-MP">CASE</span>
				防水の美学</h2>
			<div class="caseWrap">
				<ul class="slider slide contents">
					<li class="slick-slide"><div class="caseImage"><div class="sNO1"></div></div></li>
					<li class="slick-slide"><div class="caseImage"><div class="sNO2"></div></div></li>
					<li class="slick-slide"><div class="caseImage"><div class="sNO3"></div></div></li>
					<li class="slick-slide"><div class="caseImage"><div class="sNO4"></div></div></li>
					<li class="slick-slide"><div class="caseImage"><div class="sNO5"></div></div></li>
					<li class="slick-slide"><div class="caseImage"><div class="sNO6"></div></div></li>
				</ul>
			</div>
        </section>
		
		
		<!-- lab -->		
		<section id="lab">
			<div class="rellax droprL2" data-rellax-speed="4" data-rellax-percentage="0.5"><div></div></div>
			<div class="rellax droprR2 dropS" data-rellax-speed="4" data-rellax-percentage="0"><div></div></div>

			<h2 class="contents"><span class="font-MP">LAB</span>
			防水ラボ</h2>

			<div class="labTtl contents"><img src="{{ asset('images/lab/lab.png') }}" alt="Dr.ボースイの防水がない世界"></div>
				
			<div class="buttonArea contents"><a href="lab/" class="button">「もっと知りたい　防水の世界」をのぞく</a></div>
		</section>
		
		<!-- movie -->
		<section id="movie">
			<div class="rellax droprL2 dropS" data-rellax-speed="3" data-rellax-percentage="0.3"><div></div></div>

			<h2 class="contents"><span class="font-MP">MOVIE</span>
				イメージムービー</h2>

			<div class="movieWrap contents">
				<div class="movie"><iframe width="560" height="315" src="https://www.youtube.com/embed/pcpEXoDJm80" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></div>
			</div>
			
			<div class="Ttl contents">「防水」って、なに？</div>
			
		</section>

@endsection

@section('slick-relax-js')
<script type="text/javascript" src="{{ asset('js/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/rellax.min.js') }}"></script>
<script>
	$(function() {
		$('.slide').slick({
			infinite: true,
			initialSlide:0,
			slidesToShow: 3,
			dots:false,
			arrows: true,
			variableWidth:false,
			cssEase: 'linear',
			speed:500,
			centerMode: true,
			centerPadding: "10%",
            responsive: [{
            breakpoint: 640,
            settings: {
				centerPadding: "25%",
				slidesToShow: 1,
            }
           }]
		});
		var rellax = new Rellax('.rellax');
		
		setTimeout(function(){
			$('#keyvisual').css({'animation': 'keyvisual 2.8s ease-in 0s 1 normal forwards'});
			$('.catch').css({'animation': 'Blur 4s ease-in-out 0s 1 normal forwards'});
			$('.scroll').css({'animation': 'keyvisual 4s ease-in-out .5s 1 normal forwards'});
			$('#lead').css({'animation': 'keyvisual 4s ease-in-out .5s 1 normal forwards'});
		}, 200);
	});
</script>
@endsection