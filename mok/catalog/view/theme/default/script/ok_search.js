$(function(){
    var $search = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            $('.lazy').picLazyLoad();
            var _H = _W / 640 * 346;
            this.bindEvent();
        },
        showPop:function(html,time){
            time = time?time:400;
            $('.ok_pop').html(html);
            $('.ok_position').show();
            setTimeout(function(){$('.ok_position').hide();},time)
        },
        bindEvent:function(){
        	$('#button-search').on('click', function() {
				url = 'index.php?route=product/search';
				var search = $('input[name=\'search\']').prop('value');
				if (search) {
					url += '&search=' + encodeURIComponent(search);
				}
				window.location.href = url;
			});

		$('input[name=\'search\']').on('keydown', function(e) {
			if (e.keyCode == 13) {
				$('#button-search').trigger('click');
			}
		});
		var search = $('#button-search').attr('data-search');
		var page = Number($('#button-search').attr('data-page')) + 1;
		var flag = true;
		var $result = $('.ok_search_result');
		$(window).scroll(function(){
			var docHeight = $(document).height()-50,
				scrollHeight = $(window).height()+$(window).scrollTop();
				if(docHeight<scrollHeight){
					if(flag == true){
						flag = false;
						$.ajax({
							url: 'index.php?route=product/search/down&search=' + search + '&page=' + page,
							dataType: 'json',
							beforeSend: function() {

							},
							complete: function() {
						
							},
							success: function(json) {
								$('<div class="ok_push_load">上拉加载图文详情<img src="catalog/view/theme/default/images/public/pushload.gif" class="ok_push_img"/></div>').insertAfter('.ok_search_result');
								var $product = json[products],
									_str = '';
								page++;
								for(var i=o,l=$product.length;i<l;i++){
									str +='<div class="weui-cell"><div class="weui-cell__hd"><a href="#"><img src="';
									str += $product.thumb;
			                		str += '" width="100%"></a></div><div class="weui-cell__bd"><a href="#"><p class="ok_order_name">';
									str += $product.name;
									str += '</p><p class="ok_order_price">￥';
									str += $product.price;
									if($product.special){
										str += '<del>￥'+$product.special+'</del>'
									}
			                        str += '</p></a></div></div>';
								}
								$('.ok_push_load').remove();
								$(".ok_search_result").html(str);
								flag = true;
							},
							error: function(xhr, ajaxOptions, thrownError) {
								$search.showPop(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
							}
						});
					}
				}	
		});
		$('#clear-history').on('click',function(){
			$.ajax({
				url: 'index.php?route=product/search/clean',
				dataType: 'json',
				beforeSend: function() {

				},
				complete: function() {
					
				},
				success: function(json) {
					$('.ok_history').html('');
					var _str = json[0];
					$search.showPop(_str);
				},
				error: function(xhr, ajaxOptions, thrownError) {
					$search.showPop(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		});
		}
    };
    $search.init();
});

