$(function(){
    var $article = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            $('.lazy').picLazyLoad();
            var _H = _W / 640 * 346;
            this.play();
            this.collect();
            this.drawImg();
        },
        drawImg:function(){
            var $video = document.getElementById("ok_media"),
                _scale = .8;
            $video.addEventListener('loadeddata',function(){
                var canvas = document.createElement("canvas");
                canvas.width = $video.videoWidth * _scale;
                canvas.height = $video.videoHeight * _scale;
                canvas.getContext('2d').drawImage($video, 0, 0, canvas.width, canvas.height);
                $video.setAttribute('poster',canvas.toDataURL("image/png"));
            });
        },
        showPop:function(html,time){
            $('.ok_pop_info').html(html);
            $('.ok_position').show();
            setTimeout(function(){$('.ok_position').hide();},time)
        },
        collect:function(){
        	$('.ok_play_collect').click(function(){
        		var $this = $(this);
                var article_id = $("#article_id").val();
        		$.ajax({
        			url:'index.php?route=account/collect_article/add',
                    data:{article_id:article_id},
        			dataType:'json',
                    type:'post',
        			success:function(json){
                        var _pop = '';
                        if(json.status == 1 || json.status == 3){
                                $this.attr('src','catalog/view/theme/default/images/home/collected.png');
                                $('.ok_tag').removeClass('ok_fail_in').addClass('weui-icon-success-circle');
                                if(json.status == 1){
                                    _pop ='收藏成功'; $article.showPop(_pop,500);
                                }else{
                                    _pop = '收藏成功，请<a href="http://mok.localweb.com/index.php?route=account/login">登录</a>';
                                     $article.showPop(_pop,2000);
                                }
                        }
                        if(json.status == 2 || json.status == 4){
                            $this.attr('src','catalog/view/theme/default/images/home/vedio_collect.png');
                            $('.ok_tag').removeClass('weui-icon-success-circle').addClass('ok_fail_in');
                            if(json.status == 2){
                                _pop ='取消收藏'; $article.showPop(_pop,500);
                            }else{
                                _pop = '取消收藏，请<a href="http://mok.localweb.com/index.php?route=account/login">登录</a>';
                                 $article.showPop(_pop,2000);
                            }
                        }
        			}
        		});
        	})
        },
        play:function(){
            var $media = document.getElementById('ok_media');
            $('.ok_play').click(function(){
                $media.play();
                $('#ok_media').attr('controls','controls');
                $(this).hide();
            });
        }
    };
    $article.init();
});
