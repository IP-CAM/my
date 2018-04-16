// 动效配置
/*window.sr = new scrollReveal({
    //reset: true,
    move: '200px',
    mobile: true
});*/


(function ($) {

//手机界面展示
    $(".mobileface-slide").slide({
        effect: "fold"
    });

//购物流程轮播
    $(".flow-slide").slide({
        trigger: "click",
        effect: "leftLoop",
        delayTime: 500,
        easing: 'linear',
        startFun: function (i, c) {
            $(".flow-slide .hd").removeClass("hd-0 hd-1 hd-2 hd-3 hd-4").addClass("hd-" + i);
            $(".flow-slide .title li").eq(i).show().siblings().hide();
        }
    })

    /* -------------------------- 头部 ---------------------------- */
//二级菜单宽度自适应
    $(window).on('resize', function () {
        var div = $(".js-fullwidth");
        div.css('width', $('body').width() + 'px');
    });


    /* -------------------------- 首页 ---------------------------- */
//首页轮播
    $(".index-banner").slide({
        mainCell: ".bd ul",
        titCell: ".hd ul",
        effect: "left",
        autoPlay: true,
        autoPage: true,
        titOnClassName: "curr"
    });


//解决方案轮播
    $(".index-plan .plan-slide").slide({
        effect: "fold"
    });

// 一款好的电商系统
    $(".index-ts").slide({mainCell: ".main", titCell: ".tab li", effect: "fold", titOnClassName: "curr"});
    $(".content").slide({
        titCell: ".main li",
        mainCell: ".figure ul",
        effect: "left",
        autoPlay: false,
        titOnClassName: "curr"
    });

// 电商需求轮播
    $(".index-needs .needs-slide").slide({
        mainCell: ".bd ul",
        trigger: "click",
        delayTime: 0
    });
// 客户案例轮播
    $(".slide-container").slide({
        mainCell: ".slide-body ul",
        effect: "left",
        pnLoop: false,
        autoPlay: false,
        autoPage: true,
        scroll: 1,
        vis: 4
    });

//客户案例移动端演示
    $(".tb-icon").hover(function () {
        var type = $(this).data("type");
        var code = $(this).parents(".slide_bot").find(".yidong_code");
        if (type == "app") {
            code.find(".app_code").show().siblings().hide();
        } else if (type == "weixin") {
            code.find(".weixin_code").show().siblings().hide();
        } else if (type == "apple") {
            code.find(".apple_code").show().siblings().hide();
        } else {
            code.find(".android_code").show().siblings().hide();
        }
    }, function () {
        var code = $(this).parents(".slide_bot").find(".yidong_code");
        code.find(".code_item").hide();
    });


//新版视频
    $(".slide-video").slide({
        mainCell: ".slide-video-hd ul",
        effect: "left",
        pnLoop: false,
        autoPlay: false,
        autoPage: true,
        scroll: 1,
        vis: 5
    });

    $(".slide-video-hd li").click(function () {
        var index = $(this).index();
        $(this).addClass("on").siblings().removeClass("on");

        $(this).parents(".video_content").find(".js_videoCon").eq(index).show().siblings().hide();
    });


// 套餐价格切换
    $(".index-price .price-slide").slide({
        mainCell: ".bd",
        trigger: "mouseover",
        effect: "fade"
    });

    /* -------------------------- 系统介绍-运营模式 ---------------------------- */
    $(".operative-multiregion .multiregion-slide").slide({
        effect: 'fold'
    });

    /*收银台*/
    $(".function-list").slide({mainCell: ".bd ul", titCell: ".hd li", effect: "fold", titOnClassName: "curr"});

    $(".tabs-content").slide({
        mainCell: ".tabs-content-warp",
        titCell: ".tabs-content-right .li",
        effect: "fold",
        titOnClassName: "curr"
    });

    $(".sc-content").slide({mainCell: ".wf-list ul", titCell: ".wf-tabs li", titOnClassName: "curr"});

    /* -------------------------- 特色版本-跨境版 ---------------------------- */
    $(".kuajing-pc .view-slide").slide({
        effect: "fold"
    });
//bbc 商家入驻部分 视差移动
    $('#bbcSimg').on('mousemove', function (e) {
        var e = e || window.event;
        var offsetX = e.clientX / window.innerWidth - 0.5,
            offsetY = e.clientY / window.innerHeight - 0.5;
        $('#bbcSimg1').css('left', 160 + 10 * offsetX).css('top', 280 + 40 * offsetY);
        $('#bbcSimg2').css('left', 70 - 40 * offsetX).css('top', 350 - 50 * offsetY);
        $('#bbcSimg3').css('left', 70 + 10 * offsetX).css('top', 410 + 20 * offsetY);
        $('#bbcSimg4').css('left', 600 + 50 * offsetX).css('top', 610 + 30 * offsetY);
        $('#bbcSimg5').css('left', 640 + 80 * offsetX).css('top', 625 + 30 * offsetY);
        $('#bbcSimg6').css('left', 690 + 110 * offsetX).css('top', 625 + 30 * offsetY);
    });

    /* -------------------------- 产品终端-终端导航 ---------------------------- */
    if ($(".terminal-nav").length > 0) {
        var tnav = $(".terminal-nav");
        var navTop = tnav.offset().top;
        $(window).scroll(function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > navTop) {
                tnav.css('cssText', 'position:fixed;height:60px;background-color:#333; top:0; line-height:50px; box-shadow:0 1px 5px #666; -moz-box-shadow:0 1px 5px #666; -webkit-box-shadow:0 1px 5px #666;');
                tnav.find(".down").css({"margin-top": 10});
                tnav.find(".wrap-line").css({"top": 50});
                tnav.find(".nav_icon").css({"margin-top": 15});
                tnav.find("ul").css({"margin-top": 10});
            } else {
                tnav.css('cssText', 'position:relatite;height:80px;background-color:#EC5051; line-height:80px; box-shadow:none; -moz-box-shadow:none; -webkit-box-shadow:none;');
                tnav.find(".down").css({"margin-top": 25});
                tnav.find(".wrap-line").css({"top": 62});
                tnav.find(".nav_icon").css({"margin-top": 22});
                tnav.find("ul").css({"margin-top": 0});
            }
        });
    }

    if ($(".secNav").length > 0) {
        var tnav = $(".secNav");
        var navTop = tnav.offset().top;
        $(window).scroll(function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > navTop) {
                tnav.css('cssText', 'position:fixed;top:0;left:0;width:100%;background:#fff;z-index:99;');
                //tnav.find(".down").css({"margin-top":10});
                //tnav.find(".wrap-line").css({"top":50});
                //tnav.find(".nav_icon").css({"margin-top":15});
                //tnav.find("ul").css({"margin-top":10});
            } else {
                tnav.css('cssText', '');
                //tnav.find(".down").css({"margin-top":25});
                //tnav.find(".wrap-line").css({"top":62});
                //tnav.find(".nav_icon").css({"margin-top":22});
                //tnav.find("ul").css({"margin-top":0});
            }
        });
    }
//终端导航滑动
    var moveNav = function (o) {
        var f = $("." + o.f), a = f.find("." + o.a);
        f.css({position: "relative"});
        var moveDiv = function (w, l, a, b) {
            var div = $("<div class='wrap-line'></div>");
            f.append(div);
            if (b) {
                div.addClass("active");
            }
            div.css({position: "absolute", left: l, width: w});
            addEvent(w, l, a, div, b);
        }

        var addEvent = function (w, l, a, div, b) {
            a.each(function () {
                $(this).hover(function () {
                    if (b) {
                        div.removeClass("active");
                    }
                    var w2 = $(this).outerWidth();
                    var l2 = $(this).position().left;
                    if (o.w == true) {
                        w2 = $(this).outerWidth() / 2;
                        l2 = $(this).position().left + w2 / 2;
                    }
                    div.stop(true, false).animate({left: l2, width: w2});
                }, function () {
                    if (b) {
                        div.stop(true, false).animate({left: l, width: w}, function () {
                            div.addClass("active");
                        });
                    }
                    else {
                        div.stop(true, false).animate({left: l, width: w});
                    }
                });
            });
        }

        a.each(function (i) {
            if ($(this).hasClass("current")) {
                var w = $(this).outerWidth();
                var l = $(this).position().left;
                if (o.w == true) {
                    w = $(this).outerWidth() / 2;
                    l = $(this).position().left + w / 2;
                }
                if (i == 0) {
                    moveDiv(w, l, a, true);
                } else {
                    moveDiv(w, l, a);
                }
            }
        });
    }
    moveNav({
        f: 'terminal-nav',
        a: 'channel'
    });


    /* -------------------------- 产品终端-PC端 ---------------------------- */
    $(".pc-activity .activity-slide").slide({
        effect: "fold"
    });

    $(".pc-buy .buy-slide").slide({
        mainCell: ".bd",
        effect: "fold",
        pnLoop: false,
        autoPlay: false,
        autoPage: true
    });

    $(".pc-visual .right").slide({
        mainCell: ".bd ul",
        titCell: ".hd ul",
        effect: "left",
        autoPlay: true,
        autoPage: true,
        titOnClassName: "curr"
    });


    /* -------------------------- 产品终端-手机掌柜 ---------------------------- */
    $(".shopkeeper-happy .happy-slide").slide({
        startFun: function (i, c) {
            var img = $(".shopkeeper-happy .happy-slide").find("dl dd").eq(i).find("img");
            img.show().parent().siblings().find('img').hide();
        }
    });


    /* -------------------------- saas端 ---------------------------- */
    $("[ectype='card-area'] li").hover(function () {
        $(this).addClass("active").siblings().removeClass("active");
    });

    /* -------------------------- b2b ---------------------------- */
// 会员轻松发布采购需求
    $(".b2b_temp3 .slide").slide({
        mainCell: ".bd ul",
        trigger: "click",
        effect: "fade"
    });

    $(".gv-slide li").click(function () {
        var index = $(this).index();
        $(this).addClass("on").siblings().removeClass("on");

        $(".gv-info").find(".js_videoCon").eq(index).show().siblings().hide();
    });

    /* -------------------------- gjb ---------------------------- */
    $(".gjb-slide").slide({
        mainCell: ".bd ul",
        trigger: "click",
        effect: "fade"
    });

    /* -------------------------- 手机wap端 ---------------------------- */
//首页电商解决方案
    /*TouchSlide({
     slideCell:"#sider",
     titCell:".hd ul",
     mainCell:".bd ul",
     effect:"left"
     });

     TouchSlide({
     slideCell:"#anli",
     titCell:".hd ul",
     autoPage:true,
     effect:"left",
     pnLoop:"false"
     });*/

})(jQuery);