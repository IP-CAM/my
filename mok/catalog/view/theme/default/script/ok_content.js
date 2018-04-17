$(function(){
    var $content = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            $('.lazy').picLazyLoad();
            var _H = _W / 640 * 346;
            this.loadMore();
        },
        loadMore:function(){
            var flag = true;
            var page = 2;
            var _oldTop = $(window).scrollTop();
			var child_id = $('.ok_cs_box').attr('data-child');
            $(window).scroll(function(){
                var docHeight = $(document).height()-50,
                scrollHeight = $(window).height()+$(window).scrollTop();
                if(docHeight<scrollHeight && flag == true && _oldTop<$(window).scrollTop()){
                    flag = false;
                    _oldTop = $(window).scrollTop();
                        $.ajax({
		                    url: 'index.php?route=blog/category/down&child_id=' + child_id + '&page=' + page,
		                    dataType: 'json',
		                    beforeSend: function() {},
		                    complete: function() {},
		                    success: function(json) {
		                    	if(json.blogs){
                                    $('#ok_content').append('<div class="ok_push_load">上拉加载图文详情<img src="catalog/view/theme/default/images/public/pushload.gif" class="ok_push_img"/></div>');
		                    		var _html = '',
                                    $blogs = json.blogs,
                                    _len = $blogs.length;
                                    for(var i=0;i<_len;i++){
                                        _html += '<div class="ok_article_item"><a href="';
                                        _html += $blogs[i].link;
                                        _html += '"><div class="ok_article_img"><img class="lazy" src="';
                                        _html += $blogs[i].image;
                                        _html += '" width="100%"></div><div class="ok_articel_info"><p class="ok_articel_title">';
                                        _html += $blogs[i].title;
                                        // _html += '</p><p class="ok_articel_degree">';
                                        // _html += '[视频的数据吗?]#剧情 / 05’30”';
                                        // _html += '</p><p class="ok_articel_date">';
                                        _html += $blogs[i].created;
                                        _html += '</p></div></a></div>';
                                    }
                                    setTimeout(function(){
                                        $('.ok_push_load').remove();
                                        $('#ok_content').append(_html);
                                    },200);
                                    flag = true;
                                    page++;
		                    	}else{
                                       $('<div class="ok_over_tips">The End</div>').insertAfter('#ok_content'); 
                                } 
			                },
			                error: function(xhr, ajaxOptions, thrownError) {
			                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			                }
	             		}); 
                }
            });
        }
    };
    $content.init();
});
