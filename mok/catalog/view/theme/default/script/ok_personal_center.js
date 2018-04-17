$(function(){
	var $my = {
		init:function(){
			var $width = $(window).width()>750?750:$(window).width();
			$('html').css('fontSize',$width/7.5+'px');
		},
		
	};
	$my.init();
})

