$(function(){
    var $resume = {
        init: function () {
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize', _W / 7.5 + 'px');
            // this.getProvince();
            this.drapZone();
            this.selectAddress();
        },
        //弹窗
        showPop:function(html){
            $('.ok_pop').html(html);
            $('.ok_position').show();
            setTimeout(function(){$('.ok_position').hide();},400)
        },
        //选择日期
        selectAddress: function () {
            $('#showPicker').on('click', function () {
                $resume.getProvince();
                $('#ok_picker').css('display','block');
            });
            $('.ok_submit').click(function () {
                if($(this).attr('id') == 'ok_submit'){return false;}
                if($(".weui-cell").eq(0).find('input').val() == null || $(".weui-cell").eq(0).find('input').val() == ''){
                    $resume.showPop('收货人不能为空');
                }else if(!/^1[3|4|5|7|8]\d{9}/.test($(".weui-cell").eq(1).find('input').val())){
                    $resume.showPop('手机号码格式不对！');
                    
                }else if($("#zone").val() == null || $("#zone").val() == '' && $("#city").val() == null || $("#city").val() == '' && $("#district").val() == null || $("#district").val() == ''){
                    $resume.showPop('区域不可为空');
                }else if($(".weui-cell").eq(3).find('input').val() == null || $(".weui-cell").eq(3).find('input').val() == ''){
                    $resume.showPop('详细地址不可为空');
                }else{
                    $('.ok_form').submit();
                }  
            });
            $('.ok_cancel').click(function(){
                history.go(-1);
            })
        },
        getProvince:function(){
            $.ajax({
                url:'index.php?route=account/account/getZone',
                type:'post',
                dataType:'json',
                data:{country_id:44},
                success:function(data){
                    $resume.optionData(data);
                    $('.weui-picker__content').attr('data-id','zone');
                    $resume.confirmZone($resume.getCity);
                }
            });
        },
        getCity:function(_id){
            var flag = true;
            if(!flag){return false;}
            flag = false;
            $.ajax({
                url:'index.php?route=account/account/getCity',
                type:'post',
                dataType:'json',
                data:{zone_id:_id},
                success:function(data){
                    $resume.optionData(data);
                    $('.weui-picker__content').attr('data-id','city');
                    $resume.confirmZone($resume.getDistrict);
                    flag = true;
                }
            });
        },
        getDistrict:function(_id){
            var flag = true;
            if(!true){return false;}
            flag = false;
            var $picker = $('#showPicker'),
                $province = $('#zone'),
                $district = $('#district'),
                $city = $('#city');
            $.ajax({
                url:'index.php?route=account/account/getDistrict',
                type:'post',
                dataType:'json',
                data:{city_id:_id},
                success:function(data){
                    $resume.optionData(data);
                    $('.weui-picker__content').attr('data-id','district');
                    $resume.confirmZone();
                    flag = true;
                }
            });
        },
        optionData:function(data){
            var _html = '';
            for(var i=0,l=data.length;i<l;i++){
                _html +='<div class="weui-picker__item" data-value="'+data[i].value+'">'+data[i].name+'</div>';
            }
            $('.weui-picker__content')
                .html(_html)
                .css({
                    'transform': 'translate3d(0px,0px, 0px)',
                    'transition' :'all 0.3s'
                    });;
        },
        confirmZone:function(callback){
            $('.weui-picker__indicator').on('click',function(){
                var _index = $('.weui-picker__content').css('transform'),
                    _height = $(this).height();
                    if(_index.indexOf('translate3d')==0){
                        _index = parseInt($('.weui-picker__content').css('transform').split(',')[1]);
                    }else{
                        _index = parseInt($('.weui-picker__content').css('transform').split(',')[5]);
                    }
                    _index = Math.abs(_index)/_height;
                var _id = $('.weui-picker__content').find('.weui-picker__item').eq(_index).attr('data-value'),
                    _val = $('.weui-picker__content').find('.weui-picker__item').eq(_index).html();
                var _zone = $('.weui-picker__content').attr('data-id');
                var $picker = $('#showPicker'),
                    $province = $('#zone'),
                    $district = $('#district'),
                    $city = $('#city');
                if($('#zone').val() != '' && $('#city').val() != '' && $('#district').val() != ''){
                    $('#zone').attr('data-name','').val('');
                    $('#city').attr('data-name','').val('');
                    $('#district').attr('data-name','').val('');
                    $('#showPicker').html();
                }
                $('#'+_zone).val(_id).attr('data-name',_val);
                $picker.html($province.attr('data-name')+$city.attr('data-name')+$district.attr('data-name'));
                if(_zone == 'district'){$('#ok_picker').css('display','none');}
                if(callback){callback(_id);}
                $('.weui-picker__indicator').off('click');
            });
        },
        drapZone:function(){
            var _index = 0,
                $siblings = $('.weui-picker__content');
            $('.weui-picker__mask,.weui-picker__indicator').on('touchstart',function(e){
                var _height = $('.weui-picker__indicator').height(),
                    _id = $('.weui-picker__indicator').attr('data-id'),
                    _num = 0,
                    _oldTranslate = $('.weui-picker__content').css('transform');
                    if(_oldTranslate.indexOf('translate3d') == 0){
                        _oldTranslate = parseInt($('.weui-picker__content').css('transform').split(',')[1]);
                    }else{
                        _oldTranslate = parseInt($('.weui-picker__content').css('transform').split(',')[5]);
                    }
                    
                    _oldY = e.targetTouches || e.originalEvent.changedTouches
                    _oldY = _oldY[0].clientY;
                $(window).on('touchmove',function(e){
                    var _y = e.targetTouches || e.originalEvent.changedTouches
                        _y = _y[0].clientY,   
                        _newY = _y - _oldY + Number(_oldTranslate);  
                    $siblings.css({
                        'transform': 'translate3d(0px,'+_newY+'px, 0px)',
                        'transition' :'all 0.3s'
                    });
                    $(window).on('touchend',function(){
                        var _newHeight = _height/2;
                        _quantity = Math.floor(Math.abs(_newY)/_height);
                        if(_newY>0){
                            _newY = 0;
                        }else{
                            if(_quantity>$siblings.find('.weui-picker__item').length){
                                _quantity = $siblings.find('.weui-picker__item').length-1;
                            }
                            _newY = -_quantity*_height;
                        }
                        $siblings.css({
                        'transform': 'translate3d(0px,'+_newY+'px, 0px)',
                        'transition' :'all 0.3s'
                        });
                        _index = Math.abs(_newY/_height);
                        $(window).off('touchmove');
                    });
                });
            });
            $('#picker_cancel,#picker_confirm').click(function(){
                $('#ok_picker').hide();
            });
            $('#picker_confirm').click(function(){
                var _zone = $siblings.attr('data-id'),
                    _val = $siblings.find('.weui-picker__item').eq(_index).attr('data-value');
                $('#'+_zone).val(_val);
            });
        }
    };
    $resume.init();
});
