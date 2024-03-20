@extends('layouts.app')
@section('title', 'CONTACT｜つくりたい未来がある。（一社）エコ・ウレックス工業会')

@section('contact-css')
<link rel="stylesheet" href="{{ asset('css/recruit.css') }}">
@endsection

@section('form-css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('message-css')
<link rel="stylesheet" href="{{ asset('css/message.css') }}">
@endsection
    
@section('content')
	<!-- main-contents -->
	<div id="main-contents">
				
		<!-- message -->
        <section id="message">
			<div class="bg">
				<h2 class="contents"><span class="font-MP">MESSAGE</span>
					会長メッセージ</h2>

				<h3 class="contents"><img src="{{ asset('images/message/title.svg') }}" alt="防水の価値を、社会へ、そして、未来へ"></h3>
			</div>
			
			<div class="Txt">
				<p class="contents">
					皆様、いかがお過ごしでしょうか。<br>
					2020年に突如私たちを襲ったコロナ禍により、日々の工事はもちろん、<br class="pc">日常生活においてもさまざまなご苦労をされているとお察しします。<br>
					終わりの見えなかったコロナ禍は、工業会活動も著しく制限。<br>
					当会も微力ながら会員の皆様のお役に立ちたいという思いながらも、<br class="pc">幾度となくブレーキをかけざるを得ず、無念の日々を過ごしていたところです。
				</p>

				<p class="contents">
					さて、そんなコロナ禍による制限も、徐々に解除の傾向に。<br>
					今や会員数において国内有数の工業会となった当会では、<br class="pc">既報の通り理事会内に「企画委員会」を組織。皆様の活動周知や防水工事従事者の採用、人材育成の支援、<br class="pc">さらに当工業会の知名度を高め、世の中に防水工事や建物の防水の必要性に気付いてもらい、<br class="pc">人々が「防水」という言葉ともっと気軽に触れ合えるよう決意を新たにしているところです。<br>
					その取り組みの第一弾として、身近な防水をもっと知ってもらうために「防水が当たり前の暮らしを守る」というテーマの動画をリリース。<br>
					今後、第二弾、第三弾と新たな手法により当会と会員の皆様が一体となり、<br class="pc">世の中へ防水の価値、この仕事の魅力を発信していくことを目指しています。
				</p>

				<p class="contents">
					私たちは日々、「昨日より今日、今日より明日」という思いのもと、仕事を通してお客様に喜んでいただけるよう努めています。<br>
					それは私たち自身が成長し続けようとする姿でもあります。誰かの後に続くのではなく、<br class="pc">自らの魅力を最大限に生かし、誰かに影響を及ぼすことができる自分に気づき、<br class="pc">その「誰か」とは違う卓越性により日々の仕事や家族、友人との暮らしに変化を、進化を見つけていきたい。<br>
					エコ・ウレックス工業会関東はそんな会員様一人ひとりの力をもっと多くの人々に、社会に広めていきたいと思うのです。
				</p>

				<p class="contents">
					多くのお客様の記憶に残る仕事を通し、日々高い志を持って生きる・・・<br class="pc">そんな輝かしい未来を次の世代にも伝えていくことを願って――。
				</p>
			</div>
			
			<div class="nameWrap Wrap flexbox flexalignend flexstart">
				<div class="photo contents"><img src="{{ asset('images/message/photo.jpg') }}" alt=""></div>
				<div class="name contents"><img src="{{ asset('images/message/name.svg') }}" alt="エコ・ウレックス工業会関東　会長　脇園弘康"></div>
			</div>
		</section>
			
		<a href="#wrap" class="totop"><span></span></a>
		
	</div><!-- main-contents -->
</div><!-- wrap -->
@endsection
