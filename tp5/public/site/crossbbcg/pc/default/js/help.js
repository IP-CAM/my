$('.ly-help-left dt').click(function() {
	$(this).parents('dl').addClass('active').siblings('dl').removeClass('active');
	$(this).parents('dl').find('dd').slideDown();
	$(this).parents('dl').siblings('dl').find('dd').slideUp();
})
 ScrollToLocate($('#help-fixed'));