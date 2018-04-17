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
            $('#ok_load_submit').tap(function(){
                $('#ok_evaluate').submit();
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
                        // $data.push(this.result);
                    }
                }
            });
            function loadImg(src){
                $.ajax({
                    url:'index.php?route=weixin/review/uploadImage',
                    type:'post',
                    data:src,
                    success:function(data){alert('上传成功');}
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
