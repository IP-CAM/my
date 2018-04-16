//楼层定位
if($('[data-title]').length > 0) {
	$('[data-title]').each(function(i) {
		var _this = $(this);
		var text = _this.attr('data-title');
		var num=(i+1);
		var click_item = $('<li><span><i>F'+num+'</i><em>' + text + '</em></span></li>')
		$("#dingwei ul").append(click_item);
		var top = _this.offset().top;
		click_item.on('click', function() {
			$('body,html').animate({
				scrollTop: (top)
			}, 500);
		})
	});

    //顶部跟随搜索框

}
$(window).scroll(function() {
		var win_t = $(window).scrollTop();
		if(win_t > 500) {
			$('#dingwei').addClass('hover')
		} else {
			$('#dingwei').removeClass('hover')
		}
		if(win_t > 200) {
			$('.ly-header-fixed').addClass('show')
			
		}else{
			$('.ly-header-fixed').removeClass('show');
			$('.search-results').hide('show')
		}
		
		$('[data-title]').each(function(i) {
			var span_t = $(this).offset().top;
			var span_h=$(this).height();
			if(win_t+50 >= span_t && win_t-span_t<span_h)
					$('#dingwei li').eq(i).addClass('act').siblings().removeClass('act')
		})
	})
var bodywidth=$(window).width()
if (bodywidth>1200){
	var dwhight=(bodywidth-1200)/2-45
	$('#dingwei').css('left',dwhight+'px')

}

$('#tab_box .tabContainer li').hover(function(){
	var index=$(this).index();
	$(this).addClass('on').siblings().removeClass('on');
	$('#tab_box .box_all').eq(index).show().siblings().hide()
})
