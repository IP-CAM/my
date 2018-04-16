(function(){

    $.fn.extend({
        checks_select: function(options,code){
            var check_div = '<div>';
            $.each(options , function (i,n) {
                if ($.inArray(i,code) > -1) {
                    check_div=$("<div><input type='checkbox' checked='checked' name='housecode[]' value='" + i + "'>" + n + "</div>").appendTo($('.checks_div_select'));
                } else {
                    check_div=$("<div><input type='checkbox' name='housecode[]' value='" + i + "'>" + n + "</div>").appendTo($('.checks_div_select'));
                }

                var temp = '';
                $('.checks_div_select').find("input:checked").each(function(is){
                    if(is == 0){
                        temp=$(this).val();
                    }else{
                        temp+=","+$(this).val();
                    }
                });
                $('#test_div').val(temp);
                check_box=check_div.children();
                check_box.click(function(e){
                    temp="";
                    $('.checks_div_select').find("input:checked").each(function(i){
                        if(i==0){
                            temp=$(this).val();
                        }else{
                            temp+=","+$(this).val();
                        }
                    });
                    $('#test_div').val(temp);
                    e.stopPropagation();
                });
            })

            //$('.checks_div_select').html(check_div+'</div>')
        }

    })

})(jQuery); 