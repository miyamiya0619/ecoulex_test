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
		$(this).parents('div.areaWrap').toggleClass('display');
		$(this).parent().toggleClass('display');
		$(this).parent().toggleClass('clicked');
		$(this).parent().next('.prefArea').slideToggle();
	});
	
	/* contact 地域開閉 */
	$('#contact .selectArea.areaWrap .areaName span').click(function(){
		$(this).parent().next('.prefArea').slideToggle();
		$(this).parent().toggleClass('display');
		$(this).parent().toggleClass('clicked');
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
		}
		if(cnt_checked == cnt_input){
			$('input.'+clickArea).attr('checked', true).prop('checked', true).change();
		}
	});
	
});
