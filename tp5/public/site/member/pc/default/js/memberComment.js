


function check_comment(){
	//var is_true=true;
	// var goods=Number($('#goods').val());
	// var server=Number($('#server').val());
	// var send=Number($('#send').val());
	// var comment=$('.comment').val();
	// var comment_msg={
	// 	goods:'商品与描述相符不能为空',
	// 	server:"商家的服务态度不能为空",
	// 	send:"商家的发货速度不能为空",
	// 	comment:"评论内容最少20字",
	// 	comment_val:"商品评分不能为空",
	// };
	// if(goods==0){
	// 	layer.msg(comment_msg.goods);
	// 	return false;
	// }
	// if(server==0){
	// 	layer.msg(comment_msg.server);
	// 	return false;
	// }
	// if(send==0){
	// 	layer.msg(comment_msg.send);
	// 	return false;
	// }
	// var textnum=true;
	// var inputnum=true
	// //评论内容长度判断
	//  $('.comment-item').each(function(i){
	//
	//  	if(Number($(this).find('.count-grade input').val())==0 ){
	//  		inputnum=false;
	// 	}
	//  	if($.trim($(this).find('textarea').val()).length<20 ){
	//  		textnum=false;
	// 	}
	//  })
	//  if(!textnum){
	//  	layer.msg(comment_msg.comment);
	// 	return textnum;
	//  }
	//  if(!inputnum){
	//  	layer.msg(comment_msg.comment_val);
	// 	return inputnum;
	//  }
	// return is_true;
	
}
$('#ccomment_form').submit(function(){
    var data = $('#ccomment_form').serialize();
    var url = $(this).data('url');
    $.post(url,data,function (re) {
        if (re.code == 1) {
            layer.msg(re.msg,{'icon':1,'time':2000},function () {
                location.href=re.url;
            });
        } else {
            layer.msg(re.msg,{'icon':5,'time':2000},function(){
                return false;
            });
        }
    },'json');
    return false;
})
    //限制评论输入字数
function limitContent(content, length) {
      $('.letter-limit').find('span').text(length);
      
      $(content).keydown(function(e){
        var numView = $(this).parents('.comment-item').find('.letter-limit').find('span');
        var remaining = length - $(this).val().length;
        if(remaining < 0){
          numView.css('color', '#ff0000');
          numView.css('font-weight', 'bold');
        }else{
          numView.css('color', '#aaa');
          numView.css('font-weight', 'normal');
        }
        numView.text(remaining);
      });

      $(content).keyup(function(e){
      	$(content).removeClass('active')
         var numView = $(this).parents('.comment-item').find('.letter-limit').find('span');
        var remaining = length - $(this).val().length;
        numView.text(remaining);
        if(remaining < 0){
          numView.css('color', '#ff0000');
          numView.css('font-weight', 'bold');
        }else{
          numView.css('color', '#aaa');
          numView.css('font-weight', 'normal');
        }
      });
    };
 // setStars('#goods', 0);
 // setStars('#server', 0);
 // setStars('#send', 0);
 //setStars('#goods_grade', 5);
 $('.comment-item').each(function(i){
 	setStars($(this).find('.count-grade input')[0], 5);
 	limitContent($(this).find('textarea'), 150);
 })
//店铺评星级
function setStars(starDom, defaultVal){
  var stars = $(starDom).parent().find('.xing-box span');
  var valView = $(starDom).parents('.count-grade').find('em');
  var lang_score = $(starDom).parent().find('.xing-box').data('lang');

  $(starDom).val(defaultVal);
  if(defaultVal!=0){
    valView.text(defaultVal+lang_score);
  }else{
    valView.text('0'+lang_score);
  }

  $(stars).mouseover(function(){
    var n = $(this).index()+1;
    for (var i = 0; i < stars.length; i++) {
      if(i < n){
        $(stars[i]).addClass('act');
      }else{
        $(stars[i]).removeClass('act');
      }
    }
    valView.text(n+lang_score);

  });

  $(stars).mouseout(function(){
    for (var i = 0; i < stars.length; i++) {
      if(i >= defaultVal){
        $(stars[i]).removeClass('act');
      }else{
        $(stars[i]).addClass('act');
      }
    }
    if(defaultVal!=0){
      valView.text(defaultVal+lang_score);
    }else{
      valView.text('0'+lang_score);
    }

  });

  $(stars).click(function(){
      var n = $(this).index();
      $(starDom).val(n+1);
      defaultVal = $(this).index()+1;
  });
};

 $('.images-upload').each(function (i) {
     var _this=$(this);
     var url=_this.data('url');
     var max_length=_this.data('maxlength');
     var uploadid=_this.find('.action-upload');
     var goods_id=_this.data('goods_id');
     var sku=_this.data('goods_sku');
     _this.on('click','.action-remove',function(){
         $(this).parents('.handle').remove();
         if(_this.find('.handle').length<max_length){
             uploadid.show();
         }
     });
     new AjaxUpload(uploadid, {
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
             if(_this.find('.handle').length>=max_length-1){
                 _this.find('.action-upload').hide();
             }
             var _html = '<li class="handle img-thumbnail"><i class="icon-close-b action-remove">×</i><input type="hidden" name="comment['+goods_id+']['+sku+'][img][]" value="'+data.url+'" /><img src="'+data.url+'" alt=""/></li>';
             uploadid.before(_html);
         }
     });
 });

 $('.comment_img').click(function () {
     var id = $(this).parent().attr('id');
     layer.photos({
         photos: '#'+id
         ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
     });
 })
