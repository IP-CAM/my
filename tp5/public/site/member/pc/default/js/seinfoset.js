jeDate({
		dateCell:"#dateinfo",
		format:"YYYY-MM-DD", //日期格式
		isinitVal:false,
		isTime:false, //isClear:false,
		minDate:"1900-09-19 00:00:00"
		
})

$("#info_but").click(function() {
    var nickname = $(this).parents('#info_form').find("[name=nickname]").val();
    if(nickname == ''){
        layer.msg($(this).data('error_empty'), {icon:1, time: 2000});
        return false;
    }
    $.ajax({
         type: "POST",
         url: $(this).data('url'),
         data: $('#info_form').serialize(),
         dataType: "json",
         success: function(res){
             if (res.code) {
                 layer.msg(res.msg, {icon:1, time: 2000}, function(){
                     if(res.url){
                         parent.location.href=res.url;
                     }else{
                         parent.location.reload();
                     }
                 });
             } else {
                 layer.msg(res.msg, {icon:2, time: 2000});
             }
             return false;
         }
     });
    return false;
});

$('.upload').click(function () {
    $('#headimg').trigger('click');
    var _this = $(this);
    var url=_this.data('url');
    new AjaxUpload(_this, {
        action: url,
        name: 'file',
        data:{} ,
        autoSubmit: true,
        dataType:'json',
        responseType:'json',
        onComplete: function(file, response) {
            var  data=response;
            if(!data.code){
                layer.msg(data.msg);return false;
            }
            var _html = '<img src="'+data.url+'" alt="" width="80" height="80"/><input type="hidden" name="headimg" value="'+data.url+'"/>';
            $('.img-box').empty().html(_html);
        }
    });
});


