$(function(){
	const hash = location.hash;
	if(hash){
		$("html, body").stop().scrollTop(0);
		setTimeout(function(){
			const target = $(hash),
				  navH = $('.navigation').outerHeight(),
				  position = target.offset().top -navH;
			$("html, body").animate({scrollTop:position}, 800, "swing");
		});
	}
	
	var cnum = 1;
	$('.contents').each(function(){
		var targetElementF = $(this).offset().top;
		var windowHeightF = $(window).height();
		if (targetElementF <= windowHeightF + 30){
			$(this).css({'animation': 'dispAnimation .5s ease-in-out '+cnum * .09+'s 1 normal forwards'});
			cnum ++;
		}
	});

	/* メニュー */
	$('#menu .btn_menu').click(function(){
		if($(document).outerWidth() < 1090){
			$('.menu-trigger').toggleClass('active');
			$('#menu nav .navWrap').fadeToggle(600);
		}
	});
	$('#menu .mainNav').click(function(){
		$(this).next('.subNav').slideToggle();
	});

	/* modal */
	$('body,document').on('click', '#case .slick-current .caseImage', function(){
		var slideNo = $(this).children('div').attr('class');
		$('.pupWrap .slider, #arrowsP, #apDotsP').html('');
		$('.pupWrap .slider').removeClass('slick-initialized slick-slider slick-dotted');
		
		if(slideNo == 'sNO1'){
			$('.slide-P').html('<div class="slick-slide"><img src="../images/case/case01.jpg" alt=""></div><div class="slick-slide"><img src="../images/case/case01-1.jpg" alt=""></div><div class="slick-slide"><img src="../images/case/case01-2.jpg" alt=""></div>');
			$('.pupWrap .Txt p').html('駒沢オリンピック公園管制塔／2015年3月23日<br>ＤSカラーゼロ(ウレタン防水)他');
		}else if(slideNo == 'sNO2'){
			$('.slide-P').html('<div class="slick-slide"><img src="../images/case/case02.jpg" alt=""></div><div class="slick-slide"><img src="../images/case/case02-1.jpg" alt=""></div>');
			$('.pupWrap .Txt p').html('都内某学校／2021年<br>エバーコートZero-1S（ウレタン防水）<br>エバーコートZero-1H（ウレタン防水）');
		}else if(slideNo == 'sNO3'){
			$('.slide-P').html('<div class="slick-slide"><img src="../images/case/case03.jpg" alt=""></div>');
			$('.pupWrap .Txt p').html('ロレックス ラーニングセンター<br>Sikaplan（塩ビシート防水）');
		}else if(slideNo == 'sNO4'){
			$('.slide-P').html('<div class="slick-slide"><img src="../images/case/case04-2.jpg" alt=""></div><div class="slick-slide"><img src="../images/case/case04.jpg" alt=""></div><div class="slick-slide"><img src="../images/case/case04-1.jpg" alt=""></div>');
			$('.pupWrap .Txt p').html('マンション  共用廊下<br>ダイナフロア　長尺シート');
		}else if(slideNo == 'sNO5'){
			$('.slide-P').html('<div class="slick-slide"><img src="../images/case/case05.jpg" alt=""></div>');
			$('.pupWrap .Txt p').html('緑化システム採用物件<br>グリーンプレイス（ウレタン防水＋緑化）');
		}else if(slideNo == 'sNO6'){
			$('.slide-P').html('<div class="slick-slide"><img src="../images/case/case06.jpg" alt=""></div><div class="slick-slide"><img src="../images/case/case06-1.jpg" alt=""></div><div class="slick-slide"><img src="../images/case/case06-2.jpg" alt=""></div>');
			$('.pupWrap .Txt p').html('ルネ上星川／2014年<br>エバーコートZero-1H（ウレタン防水）');
		}
		setTimeout(function(){
			slickDisp();
		},200);
		
		function slickDisp(){
			
			$('.slide-P').not('.slick-initialized').slick({
				infinite: false,
				initialSlide: 0,
				fade:true,
				appendArrows: $('#arrowsP'),
				prevArrow: '<div class="slide-arrow prev-arrow"><img src="../images/common/arrow.svg"></div>',
				nextArrow: '<div  class="slide-arrow next-arrow"><img src="../images/common/arrow.svg"></div>',
				customPaging: function(slider, i) {
					var targetImage = slider.$slides.eq(i).find('img').attr('src');
					return $('<img src="'+targetImage+'" alt="">');
				  },
				dots:true,
				variableWidth:false,
				speed:500,
				autoplaySpeed:1200,
				responsive: [
			   {
				breakpoint: 640,
				settings: {
				  centerPadding:'0'
				}
			   }
			 ]
			});
		}
		
		$('.opwin .menu-trigger').addClass('active');
		$('.opwin .mordalinner').addClass('disp');
		$('.opwin').css('z-index', '20000').stop().animate({'opacity': 1}, 200, 'easeInOutQuint');
		bodyFixedOn();
	});
	$('#btn_win, .close_win').click(function(){
		$('.mordalinner').removeClass('disp');
		$('.opwin').stop().animate({'opacity': 0}, 800, 'easeInOutQuint');
		bodyFixedOff();
		setTimeout(function(){
			$('.opwin').css('z-index', '-100');
		},500);
	});
		
	
/* スクロールを固定（modal）*/
var $body = $('body');
var scrollTop;
function bodyFixedOn() {
  scrollTop = $(window).scrollTop();
  $body.css({
    position: 'fixed',
    top: -scrollTop
  });
}
function bodyFixedOff() {
  $body.css({
    position: '',
    top: ''
  });
  $(window).scrollTop(scrollTop);
}

	
	/* lab */
	$('.qaArea .Btn').click(function () {
		$(this).next('div.qaList').slideToggle();
		$(this).toggleClass('open');  
	});
	
	/* 表示 */
	$(window).on("scroll", function(){
		$('.contents').each(function(){
			var targetElement = $(this).offset().top;
			var scroll = $(window).scrollTop();
			var windowHeight = $(window).height();
			if (scroll > targetElement - windowHeight + 30){
				$(this).css({'animation': 'dispAnimation .7s ease-out .44s 1 normal forwards'});			
			}
		});
		
		if($('.rellax').length){
			$('.rellax').each(function(){
				var dropElement = $(this).offset().top;
				var scrollD = $(window).scrollTop();
				var windowHeight1 = $(window).height() / 2 - 100;
				if (scrollD > dropElement - windowHeight1){
					$(this).children('div').addClass('dropN');
				}
			});
		}
		
		var scrollTop = $(window).scrollTop();
		//	menuBtn, TOPボタン
        if(500  < scrollTop){
			$('.totop').fadeIn(200);
			$('.menuBtmWrap').fadeIn(200);
		}else{
			$('.totop').fadeOut(200);
			$('.menuBtmWrap').fadeOut(200);
		}
	});
	
	var checkResize;
	$(window).on('load resize', function() {
		clearTimeout( checkResize );
		checkResize = setTimeout( resizing, 100 );
	});


	/* リサイズ完了時に実行する処理 */
	function resizing() {
		var w = $(document).outerWidth();
		if( w > 1090 ) {
			$('#menu .menu-trigger').removeClass('active');
			$('#menu nav .navWrap').fadeIn(600);
		}else{
			var navT = $('.menu-trigger').attr('class');
			if(navT == 'menu-trigger active'){
				$('#menu .menu-trigger').addClass('active');
				$('#menu nav .navWrap').fadeIn(0);
			}else{
				$('#menu .menu-trigger').removeClass('active');
				$('#menu nav .navWrap').fadeOut(200);
			}
		}
	}
	
	// aタグのクリック
	$("a").click(function(e){
		
	// スクロールに使用する要素・イベントを設定
	var $scrollElement = getFirstScrollable("html,body"),
		mousewheel = "onwheel" in document ? "wheel" : "onmousewheel" in document ? "mousewheel" : "DOMMouseScroll";

		var navigationH = $('.navigation').outerHeight();
		var windowW = $(document).outerWidth();
		var contID = $('.menu-trigger').attr('class');
		if(contID == 'menu-trigger active' && windowW < 1090){
			$('.menu-trigger').toggleClass('active');
			$('#menu nav .navWrap').fadeToggle(600);
		}

		var $target = $(this.hash),
			top,
 			href = $(this).prop("href"),
            hrefPageUrl = href.split("#")[0],
            currentUrl = location.href,
            currentUrl = currentUrl.split("#")[0];

		var windowWidth = $(window).width();

        //#より前の絶対パスが、リンク先と現在のページで同じだったらスムーススクロールを実行
        if(hrefPageUrl == currentUrl){
			// 指定した要素が存在しない場合は未処理とする
			if( $target.length < 1 ) return false;
	
			top = $target.offset().top - navigationH;
			$(document).on(mousewheel, function(e){ e.preventDefault(); });

			$scrollElement.stop().animate({scrollTop: top}, 800, function(){
				$(document).off(mousewheel);
			});

		}
	});
	
});

// htmlとbody、どちらかスクロール可能な要素を取得
		function getFirstScrollable(selector){
			var $scrollable;

			$(selector).each(function(){
			  var $this = $(this);
			  if( $this.scrollTop() > 0 ){
				$scrollable = $this;
				return false;
			  }else{
				$this.scrollTop(1);
				if( $this.scrollTop() > 0 ){
				  $scrollable = $this;
				  return false;
				}
				$this.scrollTop(0);
			  }
			});

			return $scrollable;
		 }
