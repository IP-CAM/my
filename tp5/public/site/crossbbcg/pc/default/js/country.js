if($('#country_nav_box').length>0){
ScrollToLocate($('#country_nav_box'))

$(window).scroll(function() {
	var win_t = $(window).scrollTop();
	$('.country_prd').each(function(i) {
		var span_t = $(this).offset().top;
		var span_h = $(this).height();
		
		if(win_t + 70 >= span_t && win_t - span_t < span_h){
			$('.country-nav-w li').eq(i).addClass('active').siblings().removeClass('active')
			$('.country-nav-right li').eq(i).addClass('active').siblings().removeClass('active')
		}
			
	})
})

	$('.country-nav-w li').each(function(i) {
		var _this = $(this);
	
		var top =$('.country_prd').eq(i).offset().top;
		_this.on('click', function() {
			$('body,html').animate({
				scrollTop: (top-$('#country_nav_box').height()-30)
			}, 500);
		})
	});
	$('.country-nav-right li').each(function(i) {
		var _this = $(this);
		var top =$('.country_prd').eq(i).offset().top;
		_this.on('click', function() {
			$('body,html').animate({
				scrollTop: (top-$('#country_nav_box').height()-30)
			}, 500);
		})
	});
	
}
$('.brandWrap').hover(function(){
	
	$(this).find('.brandDesc').animate({
		top:"-50px"
	},300)
},function(){
	$(this).find('.brandDesc').animate({
		top:"0px"
	},300)
})