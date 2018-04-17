$(function(){
	$('#ok_eval_val').click(function(){
		$(this).siblings().hide();
	});
    $('#ok_load_submit').click(function () {
    	if($("#ok_eval_val").val() == null || $("#ok_eval_val").val() == ''){
    		$('.ok_eval_text').show();
            $('.ok_pop').html('评论不可为空');
            $('.ok_position').show();
            setTimeout(function(){$('.ok_position').hide();},500);
    	}else{
    		$('.ok_eval_text').show();
    		$('.ok_pop').html('评论成功');
            $('.ok_position').show();
            setTimeout(function(){$('.ok_position').hide();$("#ok_evaluate").submit();},400);
    	}
       
    })
});
