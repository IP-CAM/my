$(function(){
    var $evaluate = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            var _H = _W / 640 * 346;
            this.uploadImg();
            this.chooseStar();
            this.submitEval();
        },
        //提交评价
        submitEval:function(){
            $('#ok_load_submit').click(function(){
                if($('body').find('#email').length>0){
                    if($("#ok_eval_val").val().length>0 && $('#email').val().length>0 && /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/.test($('#email').val())){
                        $('#ok_evaluate').submit();
                        return false;
                    }else{
                        if($("#ok_eval_val").val().length<1){
                            $evaluate.showPop('反馈内容不能为空');
                            return false;
                        }
                        if($('#email').val().length<1 || /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/.test($('#email').val())){
                            $evaluate.showPop('填写正确的邮箱地址');
                            return false;
                        }
                    }
                }else{
                    if($('.ok_star_box').find('.ok_star_on').length>0 && $("#ok_eval_val").val().length>0){
                        $('#ok_evaluate').submit();
                    }else{
                        if($('.ok_star_box').find('.ok_star_on').length<1){
                            $evaluate.showPop('点亮星星评级吧');
                            return false;
                        }
                        else if($("#ok_eval_val").val().length<1){
                            $evaluate.showPop('不要忘记评语哟');
                        }
                    }
                }
                
            });
            $('#ok_eval_val').focus(function(){
                $(this).siblings('.ok_eval_text').hide();
            }).blur(function(){
                $(this).siblings('.ok_eval_text').show();
            });
        },
        showPop:function(html){
            $('.ok_pop').html(html);
            $('.ok_position').show();
            setTimeout(function(){$('.ok_position').hide();},1000)
        },
        //上传图片
        uploadImg:function(){
            // var $data = [];
            $('#ok_load_img').change(function(e){
                var $this = $(this);
                var _suffix = $this.val().substr(Number($this.val().indexOf('.'))+1).toUpperCase();
                if(this.files && this.files[0]){
                    var _file = this.files[0],
                        imgUrl = new FileReader();
                    imgUrl.readAsDataURL(_file);
                    imgUrl.onload = function(){
                        if(!(_suffix =='JPG' || _suffix == 'PNG'|| _suffix == 'JPEG'|| _suffix=='TIFF'|| _suffix=='BMP')){
                            $evaluate.showPop('骚年，格式好像不对吧！你换张试试');
                        }else{
                            $this.attr('src',this.result);
                            var _str = '<li class="ok_img_wrap"><img src="'+this.result+'" width="100%">'+'</li>';
                            $('.ok_img_list').append(_str);
                            loadImg(this.result);
                        }
                    }
                }else{
                    $this.select();
                    var _src = document.selection.createRange().text;
                    if(!(_suffix =='JPG' || _suffix == 'PNG'|| _suffix == 'JPEG'|| _suffix=='TIFF'|| _suffix=='BMP')){
                        $evaluate.showPop('骚年，格式好像不对吧！你换张试试');
                    }else{
                        var _str = '<li class="ok_img_wrap"><img src="'+this.result+'" width="100%">'+'</li>';
                        $('.ok_img_list').append(_str);
                        loadImg(this.result);
                    }
                }
            });
            $('#ok_take_photo').change(function(e){
                var $this = $(this);
                var _suffix = $this.val().substr(Number($this.val().indexOf('.'))+1).toUpperCase();
                if(this.files && this.files[0]){
                    var _file = this.files[0],
                        imgUrl = new FileReader();
                    imgUrl.readAsDataURL(_file);
                    imgUrl.onload = function(){
                        if(!(_suffix =='JPG' || _suffix == 'PNG'|| _suffix == 'JPEG'|| _suffix=='TIFF'|| _suffix=='BMP')){
                            $evaluate.showPop('骚年，格式好像不对吧！你换张试试');
                        }else{
                            $this.attr('src',this.result);
                            var _str = '<li class="ok_img_wrap"><img src="'+this.result+'" width="100%">'+'</li>';
                            $('.ok_img_list').append(_str);
                            // $data.push(this.result);
                        }
                    }
                }else{
                    $this.select();
                    var _src = document.selection.createRange().text;
                    if(!(_suffix =='JPG' || _suffix == 'PNG'|| _suffix == 'JPEG'|| _suffix=='TIFF'|| _suffix=='BMP')){
                        $evaluate.showPop('骚年，格式好像不对吧！你换张试试');
                    }else{
                        var _str = '<li class="ok_img_wrap"><img src="'+this.result+'" width="100%">'+'</li>';
                        $('.ok_img_list').append(_str);
                    }
                }
            });
            function loadImg(src){
                $.ajax({
                    url:'index.php?route=weixin/review/uploadImage',
                    type:'post',
                    data:{image:src},
                    success:function(data){$evaluate.showPop('上传成功');}
                })
            }
        },
        chooseStar:function(){
            $('.ok_star').click(function(){
                var $this = $(this),
                    _index = $this.index(),
                    _flag = $this.hasClass('ok_star_on')?true:false;
                if(_flag){
                    for(var j=_index-1,k=6;j<k;j++){
                        $('.ok_star_box').find('.ok_star').eq(j).removeClass('ok_star_on');
                    }
                    $('#ok_star_val').val(_index-1);
                }else{
                    for(var i= 0,l=_index;i<l;i++){
                        $('.ok_star_box').find('.ok_star').eq(i).addClass('ok_star_on');
                    }
                    $('#ok_star_val').val(_index);
                }
            })
        }
    };
    $evaluate.init();
});
