@extends('layouts.app')
@section('title', 'FUTURE｜つくりたい未来がある。（一社）エコ・ウレックス工業会')

@section('future-css')
<link rel="stylesheet" href="{{ asset('css/future.css') }}">
@endsection

@section('content')
<!-- main-contents -->
	<div id="main-contents">
			
		<!-- future -->
        <section id="future">
			<div class="bg">
				<h2 class="contents"><span class="font-MP">FUTURE</span>
					これからの防水</h2>

				<h3 class="contents">時代に合わせて、進化と変化を続ける防水。<br>
					ほら、今日もどこかで、誰も知らない新しい防水が生まれようとしています。</h3>
			</div>
			
			<div class="ftArea" id="cont01">
				<div class="Box contents">
					<div class="Icon contents"><div><img src="{{ asset('images/future/future01.png') }}" alt=""></div></div>
					<p class="BoxTtl contents">進化する防水</p>
					
					<p class="BoxTxt contents">「防水」という言葉からイメージするものはさまざまですが、中には「イメージがわかない」という人もいるのでは。<br>
						そんな人でもピンとくるであろう一例が「学校の屋上」。碁盤の目のように敷き詰められたあの構造もまた「防水」です。<br><br>
						実はあの構造、目に見えているコンクリートの下に「アスファルト防水」という防水加工を施工。もし、この防水加工がされていなかったら、雨の日の教科書やノートは使い物になりませんし、家屋であればお気に入りのゲームのデータが消えてしまう可能性だってあるのです。<br><br>
						近年、そんな建物の防水加工として主流なのが「ウレタン防水」という防水材。ハチミツのようなとろみのある液体で、塗り広げると化学反応でゴムのように伸縮する性質を帯びています。<br>
						液体ゆえに隙間なく塗ることができ、切れ目のない膜を形成するウレタン防水。それは、今この瞬間にも人々の暮らしを便利にすべく、進化を続けているのです。</p>
					
					<div class="ImagesSP flexbox flexbetween">
						<div class="photo contents"><img src="{{ asset('images/future/future01-2.jpg') }}" alt=""></div>
						<div class="photo contents"><img src="{{ asset('images/future/future01-3.jpg') }}" alt=""></div>
						<div class="photo contents"><img src="{{ asset('images/future/future01-4.jpg') }}" alt=""></div>
						<div class="photo w100 contents"><img src="{{ asset('images/future/future01-1.jpg') }}" alt=""></div>
					</div>
				</div>
				<div class="Images">
					<div class="photo contents"><img src="{{ asset('images/future/future01-1.png') }}" alt=""></div>
				</div>
			</div>
			
			<div class="ftArea" id="cont02">
				<div class="Box contents">
					<div class="Icon contents"><div><img src="{{ asset('images/future/future02.png') }}" alt=""></div></div>
					<p class="BoxTtl contents">防水デザインの今</p>
					
					<p class="BoxTxt contents">今や改修工事だけでなく新築工事、とりわけデザイン性の高い建造物への採用が増えているウレタン防水。その背景にあるのが、ウレタン防水ならではの加工しやすさにあります。<br><br>
						デザイン性の高い建造物は複雑な形状をしていることが多く、それは防水に関わる人にとってかなりの難題。というのも、形が複雑だと、防水加工が施しづらいからです。<br><br>
						液体を流し塗り広げていくウレタン防水なら、細部までしっかり行き届かせることができます。つまり、「防水をしたい場所の形そっくりに防水層を形成してくれる」。これこそがウレタン防水のメリットであり、建築家からも好まれる理由でもあるのです。</p>
					<div class="ImagesSP flexbox flexbetween">
						<div class="photo contents"><img src="{{ asset('images/future/future02-1.jpg') }}" alt=""></div>
						<div class="photo contents"><img src="{{ asset('images/future/future02-2.jpg') }}" alt=""></div>
						<div class="photo contents"><img src="{{ asset('images/future/future02-3.jpg') }}" alt=""></div>
						<div class="photo contents"><img src="{{ asset('images/future/future02-4.jpg') }}" alt=""></div>
					</div>
				</div>
				<div class="Images">
					<div class="photo contents"><img src="{{ asset('images/future/future02-1.png') }}" alt=""></div>
				</div>
			</div>
			
			<div class="ftArea" id="cont03">
				<div class="Box contents">
					<div class="Icon contents"><div><img src="{{ asset('images/future/future03.png') }}" alt=""></div></div>
					<p class="BoxTtl contents">次世代建築を生み出す</p>
					
					<p class="BoxTxt contents">液体という性質上、すみずみまで塗り広げられ形状を問わないウレタン防水。<br>
						これにより、すべての建築家は独自のデザインを制限されることなく具現化することが可能となりました。鋭角な形状や円形はもちろんのこと、波うつようなデザインであっても、ウレタン防水なら思いのままです。<br><br>
						一方、近年は地球温暖化などの環境対策として植物を植える建造物も増加。このニーズに応えるように、ウレタン防水は植栽にも対応できるより硬い塗膜を形成する材料を開発しています。<br><br>
						このように今やウレタン防水は、単なる素材ではなく建築の可能性を広げるものとしてなくてはらならない存在と言えるでしょう。</p>
					<div class="ImagesSP flexbox flexbetween">
						<div class="photo contents"><img src="{{ asset('images/future/future03-1.jpg') }}" alt=""></div>
						<div class="photo contents"><img src="{{ asset('images/future/future03-2.jpg') }}" alt=""></div>
					</div>
				</div>
				<div class="Images">
					<div class="photo contents"><img src="{{ asset('images/future/future03-1.png') }}" alt=""></div>
				</div>
			</div>
		</section>
		
		
	</div><!-- main-contents -->
</div><!-- wrap -->
@endsection

</body>
</html>
