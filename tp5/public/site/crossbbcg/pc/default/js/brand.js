$('.brand-nav').find('dd').hover(function(){
	if($(this).hasClass('active')) return false;
	$(this).find('a').animate({
		top:"-60px"
	},300)
},function(){
	if($(this).hasClass('active')) return false;
	$(this).find('a').animate({
		top:"0px"
	},300)
})
 ScrollToLocate($('#brand-fixed'));