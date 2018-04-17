$(function(){
    var $resume = {
        init:function(){
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize',_W/7.5+'px');
            this.selectDate();
            this.selectSex();
            this.uploadImg();
        },
        //选择日期
        selectDate:function(){
            $('#showDatePicker').on('click',function(){
                var $this = $(this);
                weui.datePicker({
                    start: new Date().getFullYear(),
                    end: 1900,
                    onChange: function (result) {
                        optionDate(result,$this);
                    },
                    onConfirm: function (result) {
                        optionDate(result,$this);
                    }
                });
            });
            function optionDate(date,obj){
                var _year = date[0],
                    _month = Number(date[1]) + 1,
                    _day = date[2];
                obj.html(_year+"-"+_month+"-"+_day);
                $('#ok_date').val(_year+"-"+_month+"-"+_day);
            }
        },
        //选择性别
        selectSex:function(){
            $('.weui-icon-circle').click(function(){
                $(this).toggleClass('weui-icon-success');
                $resume.judgeSex($(this));
            });
        },
        //判断性别
        judgeSex:function(obj){
            var $parent = obj.parent();
            if(obj.hasClass('weui-icon-success')){
                $parent.find('.ok_input_sex').attr('checked',true);
            }else{
                $parent.find('.ok_input_sex').attr('checked',false);
            }
            $parent.siblings().find('.weui-icon-circle').removeClass('weui-icon-success');
            $parent.siblings().find('.ok_input_sex').attr('checked',false);
        },
        uploadImg:function(){
            $('#uploaderInput').change(function(e){
                    var $this = $(this);
                console.log($this.val());
                    var _suffix = $this.val().substr(Number($(this).val().indexOf('.'))+1).toUpperCase();
                    if(this.files && this.files[0]){
                        var _file = this.files[0],
                            imgUrl = new FileReader();
                        imgUrl.readAsDataURL(_file);
                        imgUrl.onload = function(){
                            if(!(_suffix =='JPG' || _suffix == 'PNG'|| _suffix == 'JPEG'|| _suffix=='TIFF'|| _suffix=='BMP')){
                                alert('骚年，格式好像不对吧！你换张试试');
                            }else{
                                $this.attr('src',this.result);
                                _imgUrl = this.result;
                                $('.ok_img').attr('src',this.result).css('opacity','1');
                            }
                        }
                    }else{
                        $this.select();
                        var _src = document.selection.createRange().text;
                        if(!(_suffix =='JPG' || _suffix == 'PNG'|| _suffix == 'JPEG'|| _suffix=='TIFF'|| _suffix=='BMP')){
                            alert('骚年，格式好像不对吧！你换张试试');
                        }else{
                            $('#uploadImg').attr('src',_src);
                            _imgUrl = _src;
                            $('.ok_img').attr('src',this.result).css('opacity','1');
                        }
                    }
                });
            $('.ok_submit').tap(function(){
                $('.ok_form').submit();
            });
            $('.ok_cancel').tap(function(){
                $('input[name="nickname"]').val('');
                $('input[name="male"]').val('');
                $('input[name="female"]').val('');
                $('.weui-icon-circle').removeClass('weui-icon-success');
            });
        }
    };
    $resume.init();
});
