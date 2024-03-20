<!doctype html>
<html lang="ja">
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KXFHB8V');</script>
<!-- End Google Tag Manager -->
	
<meta charset="utf-8">
<title>@yield('title')</title>

<meta name="description" content="～　常識を捨てて、歩こう。～　防水の価値を　社会へ。そして未来へ。防水について皆さまに知ってもらいたいコンテンツを取り揃えています。">
<meta name="viewport" content="width=device-width,maximum-scale=1,maximum-scale=10,user-scalable=yes">
<meta name="format-detection" content="telephone=no">

<!-- OGP -->
<meta property="og:site_name" content="つくりたい未来がある。（一社）エコ・ウレックス工業会">
<meta property="og:title" content="つくりたい未来がある。（一社）エコ・ウレックス工業会">
<meta property="og:description" content="～　常識を捨てて、歩こう。～　防水の価値を　社会へ。そして未来へ。防水について皆さまに知ってもらいたいコンテンツを取り揃えています。">
<meta name="twitter:card" content="summary_large_image">
<meta property="og:type" content="website">
<meta property="og:url" content="https://www.eco-ulex.com/lp/mirai_project">
<meta property="og:image" content="https://www.eco-ulex.com/lp/mirai_project/assets/images/og.jpg">
<meta name="robots" content="noindex">
<link rel="canonical" href="https://www.eco-ulex.com/lp/mirai_project">
	
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@400;500&family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/reset.css') }}">
<!-- 共通CSS -->
<!-- トップページ用CSS -->
@yield('slick-css')
<link rel="stylesheet" href="{{ asset('css/common.css') }}">

<!-- 個別CSS -->
<!-- トップページ用CSS -->
@yield('index-css')
<!-- コンタクト用CSS -->
@yield('contact-css')
<!-- コンタクト、リクルート用CSS -->
@yield('form-css')
<!-- future用CSS -->
@yield('future-css')
<!-- challenger用CSS -->
@yield('challenger-css')
<!-- lab用CSS -->
@yield('lab-css')
<!-- message用CSS -->
@yield('message-css')


<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-8781964-39', 'auto');
ga('send', 'pageview');
</script>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KXFHB8V"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	
<div id="wrap">
<!-- 共通のヘッダー内容はここに記述 -->
@include('layouts.header')

@yield('content')

@include('layouts.footer')

<!-- 共通JS -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/jquery.easing.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/common.js') }}"></script>
<!-- 個別JS -->
<!-- トップページの場合 -->
@yield('slick-relax-js')

<!-- コンタクトページ、リクルートページの場合 -->
@yield('form-js')
@yield('searchbox-js')

</body>
	
</html>
