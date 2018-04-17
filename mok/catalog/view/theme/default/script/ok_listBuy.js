$(function(){
    var $width = $(window).width()>750?750:$(window).width();
    $('html').css('fontSize',$width/7.5+'px');
    var $slider = $('.ok_list_nav');
    loadMore();
    $slider.swipeSlide({
        autoSwipe: false,
        continuousScroll:false,
        speed : 3000,
        transitionType : 'cubic-bezier(0.22, 0.69, 0.72, 0.88)',
        callback : function(i,sum,me){
        	var _li = me.find('li').eq(i);
            _li.children().addClass('ok_nav_on');
            _li.siblings().children().removeClass('ok_nav_on');
        }
    });
    //加载更多
        function loadMore(){
            var flag = true,
                child_id = $('#ok_id').val(),
                page = $('#ok_page').val();
            $(window).scroll(function(){
                var docHeight = $(document).height()-50,
                scrollHeight = $(window).height()+$(window).scrollTop();
                if(docHeight<scrollHeight && flag == true){
                        $.ajax({
                            url: 'index.php?route=product/category/down&child_id=' + child_id + '&page=' + page,
                            dataType: 'json',
                            beforeSend: function() {

                            },
                            complete: function() {
                        
                            },
                            success: function(json) {
                                if(json){
                                    var _html = '';
                                    for(var i=0,l=json.length;i<l;i++){
                                        _html += '<div class="ok_list_item"><a href="';
                                        _html += json[i].href;
                                        _html += '"><img src="';
                                        _html += json[i].thumb;
                                        _html += '" width="100%"><p class="ok_cs_info">';
                                        _html += json[i].name;
                                        _html += '</p><p class="ok_cs_price"><span class="price-new">';
                                        _html += json[i].price;
                                        _html += '</span><span class="price-old">';
                                        _html += json[i].tax;
                                        _html += '</span></p></a></div>';
                                    }
                                    $('.ok_list').append(_html);
                                    page++;
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                            }
                        });
                    flag = false;
                }
            });
        }
});