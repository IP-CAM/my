if(data.code == 200){
art.dialog({
id : '__tips',
title : '小强温馨提示',
content : '<p style="font-size: 16px">领取成功，优惠券已经发放至您的个人中心!</p><a href="http://my.okhqb.com/my/coupons.html" target="_blank" style="display:block;margin: 0 auto;text-align:center;color: #ff0000;">查看优惠券</a>',
padding: '20px 30px',
ok : true
});
}else if(data.code == 590){
OKHQB_sign.dialog({
sign_in_callback: function () {
window.location.href = window.location.href;
}
});
}else{
art.dialog({
id : '__tips',
title : '小强温馨提示',
content :'<p style="font-size: 16px;">'+data.msg+'</p>',
padding: '20px 30px',
ok : true
});
}