@extends('layouts.app')
@section('title', 'LAB｜つくりたい未来がある。（一社）エコ・ウレックス工業会')

@section('lab-css')
<link rel="stylesheet" href="{{ asset('css/lab.css') }}">
@endsection

@section('content')
	<!-- main-contents -->
	<div id="main-contents">
				
		<!-- lab -->
        <section id="lab">
			<div class="bg">
				
				<div class="labTtl contents"><img src="{{ asset('images/lab/title.png') }}" alt="Dr.ボースイの防水がない世界"></div>

				<h3 class="contents">知れば知るほど奥深い防水ワールド。<br>
					Dr.ボースイが、誰かに教えたくなるとっておきの防水豆知識をご紹介します。</h3>
			</div>
			
			<div class="labImg contents"><img src="{{ asset('images/lab/dr.png') }}" alt="Dr.ボースイ"></div>
			
			
			<div class="qaArea">
				<div class="Btn"><img src="{{ asset('images/lab/qa01.svg') }}" alt="＃もしも防水がなかったら？"></div>
				
				<div class="qaList">
					<div class="Box">
						<div class="question">どうして日本の防水はこれほど進化したの？</div>
						<div class="answer">
							<div class="Txt">意外かもしれないけど、世界の国口の中で日本の降水量はインドネシア、フィリピン、ニュージーランドに続く第４位！その量は1,690mm/年と、なんと世界平均の倍以上にもなるのだから驚きだ。こんな雨大国だからこそ、防水が進化したと言えるかもしれないね。</div>
							<div class="Img"><img src="{{ asset('images/lab/qaA01-1.png') }}" alt=""></div>
						</div>
					</div>
					
					<div class="Box">
						<div class="question">もしも、防水がなかったら暮らしはどうなるの？</div>
						<div class="answer">
							<div class="Txt">建物内に雨漏りが起きてしまう？いやいやそれだけじゃ済まないぞ。<br>
								木造住宅であれば建物の柱でもある木が腐食。鉄骨の建物であれば柱の鉄骨が錆びてしまうし、コンクリートの建物であれば、コンクリート自体の強度が低下。とても安心して暮らせる環境ではなくなってしまうね。</div>
						</div>
					</div>
					
					<div class="Box">
						<div class="question">怖い酸性雨！建物に与えるダメージは？</div>
						<div class="answer">
							<div class="Txt">森林を枯らしてしまうことで知られる酸性雨だけど、実は建物にも甚大な被害をもたらす曲者なんだ。もしも、建物に防水がなかったら、酸性雨が染み込みコンクリートの成分が溶け出してしまうことにも…。つまり、建物に防水を施すのは、建物をそのものを守ることなんだね。</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="qaArea">
				<div class="Btn"><img src="{{ asset('images/lab/qa02.svg') }}" alt="＃こんなところにも防水"></div>
				
				<div class="qaList">
					<div class="Box">
						<div class="question">最先端のビルに隠された、知られざる防水技術って？</div>
						<div class="answer flexbox flexbetween flexalignstart">
							<div class="Txt">近年、原宿に新しく建った商業施設。デザイン性のある建物でひと際存在感があるよね。「建物の上にこんなに植物を植えているなんて！」と驚いた人も多いのでは？<br>
								でも、驚くのはまだ早い！実はあの商業施設、植物の下に「防水」が施されているんだ。進化し続ける防水技術は、見えないところで街の発展にも役立っているんだね。</div>
							<div class="Img w50"><img src="{{ asset('images/lab/qaA02-1.png') }}" alt=""><img src="{{ asset('images/lab/qaA02-1.png') }}" alt=""></div>
						</div>
					</div>
					
					<div class="Box">
						<div class="question">もしも、駐車場に防水処理がされていなかったらどうなるの？</div>
						<div class="answer flexbox flexbetween flexalignstart">
							<div class="Txt">グレーやグリーンに塗られたショッピングモールの駐車場。実はあれ、すべて防水が施されているを知っていたかな？<br>
								もし、あの防水処理が無かったら、雨の日に下のフロアでショッピングしている僕たちもびしょびしょになってしまうんだ。天気を気にせず買い物を楽しめるのも、防水のおかげなんだね。</div>
							<div class="Img w50"><img src="{{ asset('images/lab/qaA02-3.png') }}" alt=""><img src="{{ asset('images/lab/qaA02-3.png') }}" alt=""></div>
						</div>
					</div>
					
					<div class="Box">
						<div class="question">スタジアムが挑む、「負けられない戦い」って何？</div>
							<div class="answer flexbox flexbetween flexalignstart">
							<div class="Txt">サッカーや野球観戦に欠かせない巨大なスタジアム。実はあの床にも防水が欠かせないんだ。しかも、何千、何万の観客がその上を歩くだけに、大きな負荷に耐えらえる強度も必要。グラウンドの外でも縁の下の力持ち「防水」が、負けられない戦いが繰り広げているんだね。</div>
							<div class="Img w50"><img src="{{ asset('images/lab/qaA02-5.png') }}" alt=""><img src="{{ asset('images/lab/qaA02-5.png') }}" alt=""></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="qaArea">
				<div class="Btn"><img src="{{ asset('images/lab/qa03.svg') }}" alt="＃防水今昔物語"></div>
				
				<div class="qaList">
					<div class="Box">
						<div class="question">アスファルトっていつから使われているの？</div>
						<div class="answer flexbox flexbetween flexalignstart">
							<div class="Txt">近代的な素材と思われがちなアスファルト。でも、紀元前3800年頃にはメソポタミア文明やインダス文明おいて防水材、防腐剤として天然アスファルトが使われていたというから驚きだね。一方わが国では、668年に「越の国（日本海側地域）から燃える水と燃える土が献上された」という記述が日本書紀にあるんだ。</div>
							<div class="Img w50"><img src="{{ asset('images/lab/qaA03-1.png') }}" alt=""><img src="{{ asset('images/lab/qaA03-1.png') }}" alt=""></div>
						</div>
					</div>
					
					<div class="Box">
						<div class="question">ウレタン防水はいつごろ生まれたの？</div>
						<div class="answer flexbox flexbetween flexalignstart">
							<div class="Txt">1963年に塗料としてのウレタンゴム樹脂が製品化。それを建物の屋根コンクリート面に塗布したり、防水モルタルのひび割れ部にシーリングを施し、その上からウレタンゴム塗料を塗布して防水皮膜を形成する工法が登場したんだ。これが現在にもつながるウレタン塗膜防水の始まりだよ。</div>
							<div class="Img w50"><img src="{{ asset('images/lab/qaA03-3.png') }}" alt=""><img src="{{ asset('images/lab/qaA03-4.png') }}" alt=""></div>
						</div>
					</div>
					
					<div class="Box">
						<div class="question">ウレタン塗膜防水工法「X-1」のはじまりは？</div>
							<div class="answer flexbox flexbetween flexalignstart">
							<div class="Txt">1977年には通気緩衝シートとウレタン塗膜防水の組み合わせによる工法が完成。それまでの下地挙動による防水層のひび割れや、膨れといった問題が解決され、公共建築工事工事標準仕様X-1の起源となったんだ。1984年ごろには新築工事での需要も出始め、今日までたくさんの技術革新が行われているよ。</div>
							<div class="Img w50"><img src="{{ asset('images/lab/qaA03-5.png') }}" alt=""><img src="{{ asset('images/lab/qaA03-6.png') }}" alt=""></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="qaArea">
				<div class="Btn"><img src="{{ asset('images/lab/qa04.svg') }}" alt="＃防水豆知識"></div>
				
				<div class="qaList">
					<div class="Box">
						<div class="question">江戸の大名屋敷にアスファルトが使われていたってホント？</div>
						<div class="answer">
							<div class="Txt">加賀100万石で知られる前田家江戸上屋敷跡（現在の東大赤門付近）には前田家厨房の煉瓦基礎が今も現存。驚くべきことに、そこにはアスファルトが固く張り付いている部分が…！これは地中の湿気から内部を保護するために塗布された、塗布防水のようなものだと考えられているんだ。</div>
						</div>
					</div>
					
					<div class="Box">
						<div class="question">太陽の塔の防水に用いられた「タールウレタン」ってどんなもの？</div>
						<div class="answer">
							<div class="Txt">1970年に開かれた高度成長期を締めくくる一大イベント、大阪万国博覧会。岡本太郎によるシンボルタワー「太陽の塔」のアーム部分の防水に使われたのがウレタン樹脂にコールタールを混ぜた「タールウレタン」というもの。ところが、ウレタン草創期とあってかこの素材は紫外線に弱いという欠点があったんだ。</div>
						</div>
					</div>
					
					<div class="Box">
						<div class="question">幕末の西洋人がとった日本の湿気対策って？</div>
							<div class="answer">
							<div class="Txt">今も昔も高温多湿の日本。19世紀に黒船を率きてやってきたペリー提督の求めに応じて横浜港が開かれると、各地に外国人居留地が出現したんだ。西洋人が住む建物では、アスファルトを湿気防止や木下地の屋根の継ぎ目として使用。はるばる海を渡って訪れた西洋人も日本の湿気には参ったようだね。</div>
						</div>
					</div>
				</div>
			</div>

		</section>
@endsection

</body>
</html>
