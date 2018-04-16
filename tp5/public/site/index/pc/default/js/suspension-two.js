var str = '<div class="main-im" id="main_im">';
    str += '<div id="open_im" class="open-im" style="display:none;">&nbsp;</div>';
    str += '<div class="im_main" id="im_main">';
    str += '<div id="close_im" class="close-im">';
    str += '<a href="javascript:void(0);" title="点击关闭">&nbsp;</a>';
    str += '</div>';
    str += '<a href="javascript:;" class="im-qq qq-a" id="btnim" title="在线客服">';
    str += '<div class="qq-container"></div>';
    str += '<div class="qq-hover-c">';
    str += '<img class="img-qq" src="'+imgUrl+'im/qq.png"/>';
    str += '</div>';
    str += '<span>在线客服</span>';
    str += '</a>';
    str += '<div class="im-tel" style="height:260px;">';
    str += '<div style="padding-top:10px; font-size:12px; text-align:center;">咨询时间</div>';
    str += '<div class="tel-num">9:00~18:00</div>';
    str += '<div style="padding-top:10px; font-size:12px; text-align:center;">服务电话</div>';
    str += '<div class="tel-num">4006-xxx-xxx</div>';
    str += '<div style="font-size:12px; text-align:center; padding-top:10px;">投诉电话</div>';
    str += '<div class="tel-num">13322936015</div>';
    str += '<div style="font-size:12px; text-align:center; padding-top:10px;">电商讨论群</div>';
    str += '<div class="tel-num"><a target="_blank" href="https://jq.qq.com/?_wv=1027&k=5g8tNQI"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="润土跨境电商①群" title="润土跨境电商①群"></a></div>';
    str += '<div style="font-size:12px; text-align:center; padding-top:10px;">通关服务群</div>';
    str += '<div class="tel-num"><a target="_blank" href="https://jq.qq.com/?_wv=1027&k=5yYoQxY"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="通关服务" title="通关服务"></a></div>';
    str += '</div>';
    str += '<div class="im-footer" style="position:relative; height:50px;">';
    str += '<div class="weixing-container fl">';
    str += '<div class="weixing-show">';
    str += '<div style="text-align:center; font-size:14px; padding-top:15px; line-height:20px;" id="weixing-scrol-2">微信扫一扫<br/>享跨境电商干货</div>';
    str += '<img class="weixing-ma" src="'+imgUrl+'weshop_interface_qrcode.png"/>';
    str += '<div class="weixing-sanjiao"></div>';
    str += '<div class="weixing-sanjiao-big"></div>';
    str += '</div>';
    str += '</div>';
    str += '<div class="go-top fr">';
    str += '<a href="javascript:;" title="To top"></a>';
    str += '</div>';
    str += '</div>';
    str += '</div>';
    str += '</div>';

    str += '<style>';
    str += '.main-im { position: fixed; right: 10px; top: 150px; width: 110px; z-index: 999; }';
    str += '.main-im .im_main { background: #f9fafb; border: 1px solid #dddddd; border-radius: 10px; }';
    str += '.main-im .im_main .close-im { height: 24px; position: absolute; right: 10px; top: -12px; width: 24px; z-index: 100; }';
    str += '.main-im .im_main .close-im a { background: url('+imgUrl+'im/close_im.png) no-repeat left top; display: block; height: 24px; width: 24px; }';
    str += '.main-im .im_main .close-im a:hover { text-decoration: none; }';
    str += '.main-im .im_main .qq-a { color: #0484cd; display: block; font-size: 14px; height: 116px; position: relative; text-align: center; width: 106px; }';
    str += '.main-im .im_main .qq-a span { bottom: 5px; left: 10px; position: absolute; width: 90px; }';
    str += '.main-im .im_main .qq-a .qq-container { background: transparent url('+imgUrl+'im/qq-icon-bg.png) no-repeat scroll center 8px; border-bottom: 1px solid #dddddd; border-top-left-radius: 10px; border-top-right-radius: 10px; height: 118px; position: absolute; width: 109px; z-index: 99; }';
    str += '.main-im .im_main .qq-a .qq-hover-c { border-radius: 35px; height: 70px; left: 18px; overflow: hidden; position: absolute; top: 10px; width: 70px; z-index: 9; }';
    str += '.main-im .im_main .qq-a .img-qq { display: block; left: 6px; max-width: 60px; position: absolute; top: 3px; transition: all 0.5s ease 0s; }';
    str += '.main-im .im_main .qq-a:hover .img-qq { left: 1px; max-width: 70px; position: absolute; top: 8px; }';
    str += '.main-im .im_main .im-tel { border-bottom: 1px solid #dddddd; color: #000000; height: 140px; text-align: center; width: 109px; line-height:18px; }';
    str += '.main-im .im_main .im-tel .tel-num { color: #140ba7; font-family: Arial; font-weight: bold; padding-top: 3px; font-size: 14px; text-align: center; }';
    str += '.main-im .im_main .weixing-container { background: transparent url('+imgUrl+'im/weixing-icon.png) no-repeat scroll center center; border-bottom-left-radius: 10px; border-right: 1px solid #dddddd; height: 47px; width: 55px; float: left; }';
    str += '.main-im .im_main .weixing-container:hover .weixing-show { display: block; }';
    str += '.main-im .im_main .weixing-show { background: #ffffff none repeat scroll 0 0; border: 1px solid #dddddd; border-radius: 10px; height: 172px; left: -132px; position: absolute; top: -126px; width: 112px; display: none; }';
    str += '.main-im .im_main .weixing-show .weixing-sanjiao { border-color: transparent transparent transparent #ffffff; border-style: solid; border-width: 6px; height: 0; left: 112px; position: absolute; top: 134px; width: 0; z-index: 2; }';
    str += '.main-im .im_main .weixing-show .weixing-sanjiao-big { border-color: transparent transparent transparent #dddddd; border-style: solid; border-width: 8px; height: 0; left: 112px; position: absolute; top: 132px; width: 0; }';
    str += '.main-im .im_main .weixing-show .weixing-ma { height: 103px; padding-left: 5px; padding-top: 5px; width: 104px; }';
    str += '.main-im .im_main .go-top { background: transparent url("'+imgUrl+'im/toTop-icon.png") no-repeat scroll center center; border-bottom-right-radius: 10px; height: 47px; width: 50px; float: right; }';
    str += '.main-im .im_main .go-top a { display: block; height: 47px; width: 52px; }';
    str += '.main-im .open-im { background: url("'+imgUrl+'im/open_im.png") no-repeat left top; cursor: pointer; height: 133px; margin-left: 68px; width: 40px; }';
    str += '.im-footer{}';

    str += '</style>';

//加载字符串
$("body").append(str);
$('#close_im').on('click', function () {
    $('#open_im').show();
    $('#im_main').hide();
})
$('#open_im').on('click', function () {
    $('#open_im').hide();
    $('#im_main').show();
})
$('.go-top').on('click', function () {
    $('body,html').animate({scrollTop: 0}, 1000);
    return false;
})