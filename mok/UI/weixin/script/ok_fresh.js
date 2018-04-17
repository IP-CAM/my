$(function(){
	var $fresh = {
		init:function(){
			var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize', _W / 7.5 + 'px');
            this.getCoup();
		},
		getCoup:function(){
			$('.ok_get_coup').click(function(){
				$.ajax({
					url:'',
					type:'post',
					dataType:'json',
					success:function(json){
						alert(json);
					}
				})
			});
		}		
	};
	$fresh.init();
})