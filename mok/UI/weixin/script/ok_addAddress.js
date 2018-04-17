$(function(){
    var $resume = {
        init: function () {
            var _W = $(window).width() > 750 ? 750 : $(window).width();
            $('html').css('fontSize', _W / 7.5 + 'px');
            this.selectAddress();
        },
        //选择日期
        selectAddress: function () {
            $('#showPicker').on('click', function () {
                var $this = $(this);
                $resume.getProvince();
            });
            $('.ok_submit').click(function () {
                $("#add_address").submit();
            });
            $('.ok_cancel').click(function(){
                history.go(-1);
            })
        },
        getProvince:function(_id){
            var $picker = $('#showPicker'),
                $province = $('#zone'),
                $district = $('#district'),
                $city = $('#city');
            $.ajax({
                url:'index.php?route=d_quickcheckout/field/getZone',
                type:'post',
                dataType:'json',
                data:{country_id:44},
                success:function(data){
                    var $data = $resume.optionData(data),
                        $zone = $data[0];
                    weui.picker($zone, {
                        onChange: function (result) {
                            $('.weui-picker__indicator').on('click',function(){
                                $province.val(result[0].id);
                                $province.attr('data-value',result[0].zone);
                                $picker.val($province.attr('data-value')+$city.attr('data-value')+$district.attr('data-value'));
                                $resume.getCity(result[0].id);
                                // $('#weui-picker-confirm').trigger('click');
                            });
                        },
                        onConfirm: function (result) {
                            
                        }
                    });
                }
            });
        },
        getCity:function(_id){
            var $picker = $('#showPicker'),
                $province = $('#zone'),
                $district = $('#district'),
                $city = $('#city');
            $.ajax({
                url:'index.php?route=d_quickcheckout/field/getCity',
                type:'post',
                dataType:'json',
                data:{zone_id:_id},
                success:function(data){
                    var $data = $resume.optionData(data),
                        $zone = $data[0];
                    weui.picker($zone, {
                        onChange: function (result) {
                            $('.weui-picker__indicator').on('click',function(){
                                $city.val(result[0].id);
                                $city.attr('data-value',result[0].zone);
                                $picker.val($province.attr('data-value')+$city.attr('data-value')+$district.attr('data-value'));
                                $resume.getDistrict(result[0].id);
                            });
                        },
                        onConfirm: function (result) {
                            console.log(result,1111);
                        }
                    });
                }
            });
        },
        getDistrict:function(_id){
            var $picker = $('#showPicker'),
                $province = $('#zone'),
                $district = $('#district'),
                $city = $('#city');
            $.ajax({
                url:'index.php?route=d_quickcheckout/field/getDistrict',
                type:'post',
                dataType:'json',
                data:{city_id:_id},
                success:function(data){
                    var $data = $resume.optionData(data),
                        $zone = $data[0];
                    weui.picker($zone, {
                        onChange: function (result) {
                            $('.weui-picker__indicator').on('click',function(){
                                $district.val(result[0].id);
                                $district.attr('data-value',result[0].zone);
                                $picker.val($province.attr('data-value')+$city.attr('data-value')+$district.attr('data-value'));
                            });
                        },
                        onConfirm: function (result) {
                            console.log(result,1111);
                        }
                    });
                }
            });
        },
        optionData:function(data){
            var $temp = {},
                _html = '',
                $arrData = [],
                $zone = [];
            for(var i=0,l=data.length;i<l;i++){
                $temp.label = data[i].name;
                $temp.value = {};
                $temp.value.id = data[i].value;
                $temp.value.zone = data[i].name;
                $zone.push($temp);
                _html +='<div class="weui-picker__item">'+$temp.label+'</div>';
                $temp = {};
            }
            $('.weui-picker__content').html(_html).css('transform','translate3d(0px, 102px, 0px)');
            $arrData.push($zone,_html);
            return $arrData;
        }
    };
    $resume.init();
});
