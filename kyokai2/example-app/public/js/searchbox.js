$(function(){
	
	var def_nav_position = $('.searchWrap').offset().top;
	var w = $(window).width();
	var fixed = 60;
	var areaW = $('.fixedWrap').width() + 'px';
	if(w > 1089){
		fixed = 140;
	}else{
		areaW = '100%';
	}
	
	/* リサイズ時 */
	var timer = false;
	var winWidth_resized;
	$(window).on('resize', function(){
		if (timer !== false) {
			clearTimeout(timer);
		}
		timer = setTimeout(function() {
			winWidth_resized = $(window).width();

			if ( w != winWidth_resized ) {
				w = $(window).width();

				if(w > 1089){
					fixed = 140;
					$('.selectArea, .prefList.active').slideDown();
					$('.selectArea').addClass('disp');
					$('.btnArea').removeClass('disp');
					$('#recruit.result .btnArea p').html('地域選択を閉じる');
					$('.btnArea').css('display', 'block');
					$('.areaBtn').slideUp();
				}else{
					fixed = 60;
					$('.areaList, .prefList.active').slideUp();
					$('.areaBtn').slideDown();
					$('.btnArea').css('display', 'none');
					$('.fixedWrap').css('width', '100%');
					$('#recruit.result .btnArea').removeClass('disp');
				}
			}
		}, 200);
	});
	
	$(window).on("scroll", function(){
		var scroll = $(window).scrollTop();
		
		/* ナビゲーション固定
			初期位置より下ならナビゲーション固定 */
		if(scroll > def_nav_position - fixed){
			$('.fixedWrap').css({
				'position': 'fixed',
				'top':  fixed + 'px',
				'width': areaW
			});
			
		}else{
			if(scroll <= def_nav_position){
				$('.fixedWrap').css({
					'position': 'relative',
					'top':'auto'
				});
			}	
		}
		
		if(w > 1089){
			$('.selectArea').slideUp();
			$('#recruit.result .btnArea').addClass('disp');
			$('#recruit.result .btnArea p').html('地域選択を開く');
		}else{
			$('.areaList').slideUp();
			$('.prefList').slideUp();
			$('#recruit.result .areaButton').removeClass('disp');
			$('#recruit.result .prefButton').removeClass('disp');
		}
	});
	
	/* 検索結果画面PC検索地域表示 */
	$('#recruit.result .btnArea').click(function(){
		$('.selectArea').slideToggle();
		$(this).toggleClass('disp');
		
		if($(this).hasClass('disp')){
			$('#recruit.result .btnArea p').html('地域選択を開く');
		}else{
			$('#recruit.result .btnArea p').html('地域選択を閉じる');
		}
	});
	
	/* 検索結果画面スマホ地域クリック時 */
	$('#recruit.result .areaButton').click(function(){
		$('.areaList').slideToggle();
		$(this).toggleClass('disp');
	});
	
	/* 検索結果画面スマホ県クリック時 */
	$('#recruit.result .prefButton').click(function(){
		var area = $('.areaButton').attr('class').replace('areaButton ', '').replace(' disp', '');
		$('.prefList.'+area).slideToggle();
		$(this).toggleClass('disp');
	});
	
});