$(function(){

	/* contact 工事選択 */
	$('#contact .selectArea.selectType label').click(function(){
		if($(this).children('input').prop('checked') ){
			$(this).addClass('selected');
		}else{
			$(this).removeClass('selected');
		}
	});
	
	/* contact 地域選択 */
	$('#contact .selectArea.areaWrap .areaBtn').click(function(){
		var selectArea = $(this).children('input').attr('class');

		if($(this).children('input.'+selectArea).prop('checked') ){
			$('input.'+selectArea).attr('checked', true).prop('checked', true).change();
			$(this).parents('div.areaWrap').addClass('display');
			$(this).parent().addClass('display');
			$(this).parent().addClass('clicked');
			$(this).parent().next('.prefArea').slideDown();
			$('label:has(input.'+selectArea+')').addClass('pclicked');
		}else{
			$('input.'+selectArea).removeAttr('checked').prop('checked', false).change();
			$(this).parent().removeClass('clicked');
			$('label:has(input.'+selectArea+')').removeClass('pclicked');
		}
	});
	
	/* contact 地域開閉 */
	$('#contact .selectArea.areaWrap .areaName span').click(function(){
		$(this).parent().next('.prefArea').slideToggle();
		$(this).parent().toggleClass('display');
		$(this).parents('div.areaWrap').toggleClass('display');
	});
	
	/* contact 県選択時 */
	$('#contact .selectArea.areaWrap .prefArea label').click(function(){
		var clickArea = $(this).find('input').attr('class');
		var cnt_input = $('.prefArea .flexbox .'+clickArea).length;
		var cnt_checked = $('.prefArea .flexbox input.'+clickArea+':checkbox:checked').length;
		
		if($(this).children('input').prop('checked') ){
			$(this).children('input').attr('checked', true).prop('checked', true).change();
			$(this).addClass('pclicked');
		}else{
			$(this).children('input').removeAttr('checked').prop('checked', false).change();
			$(this).removeClass('pclicked');
		}
		
		if(cnt_checked == 0){
			$('input.'+clickArea).removeAttr('checked').prop('checked', false).change();
			$(this).parents('.prefArea').prev('.areaName').removeClass('clicked');
		}
		if(cnt_checked == cnt_input){
			$('input.'+clickArea).attr('checked', true).prop('checked', true).change();
			$(this).parents('.prefArea').prev('.areaName').addClass('clicked');
		}
		if(cnt_checked != cnt_input){
			$(this).parents('.prefArea').prev('.areaName').removeClass('clicked');
			$(this).parents('.prefArea').prev('.areaName').find('.areaBtn input.'+clickArea).removeAttr('checked').prop('checked', false).change();
		}
	});
	
});
