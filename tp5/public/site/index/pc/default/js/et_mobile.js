//手机端访问js
$(function(){
	$(".reorder").click(function(){
		$(".js_nav").stop(true,false).slideToggle(300);
		if($(this).hasClass("active")){
			$(this).removeClass("active");
		}else{
			$(this).addClass("active");
		}
		
		$(".js_nav").find('.drop-down').removeClass('active');
		$(".js_nav").find('i').removeClass('m-icon-angle-up').addClass('m-icon-angle-down');
	});
	
	$(".drop-down").click(function(){
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			$(this).find('i').removeClass('m-icon-angle-up').addClass('m-icon-angle-down');
		}else{
			$(this).addClass('active');
			$(this).find('i').removeClass('m-icon-angle-down').addClass('m-icon-angle-up');
		}
	});
	
	if($(".section_bigdata_4").length>0){
		var width = $(".section_bigdata_4 .sj_title").width();
		$(".section_bigdata_4 .sj_title").css({"left":"50%","margin-left":-(width/2)});
	}
	
	if($(".section_commerce_1").length>0){
		var width = $(".section_commerce_1 .sj_title").width();
		$(".section_commerce_1 .sj_title").css({"left":"50%","margin-left":-(width/2)});
	}
	
	$(".back_top").click(function(){
		$("body,html").animate({scrollTop:0},200);
        return false;
	});
});