if (Private_Script) {
    RequireParam.BaseScript = RequireParam.BaseScript.concat(Private_Script);
}
require.config({
    baseUrl: RequireParam.BaseScriptPath,
    paths: {
        "jquery": "static/js/jquery",
        "fly": "static/js/jquery.fly.min",
        "carouFredSel": 'static/js/jquery.carouFredSel-6.2.1',
        "lazyload": 'static/js/jquery.lazyload',
        "carouFredSel": 'static/js/jquery.carouFredSel-6.2.1',
        "index": 'site/crossbbcg/pc/default/js/index',
        "country": 'site/crossbbcg/pc/default/js/country',
        "goodsList": 'site/crossbbcg/pc/default/js/goodsList',
        "product": 'site/crossbbcg/pc/default/js/product',
		"help":'site/crossbbcg/pc/default/js/help',
		"brand":'site/crossbbcg/pc/default/js/brand',
        "jqzoom": 'static/js/jquery.jqzoom-core-pack',
        "dialog": 'static/js/jquery.dialog',
        "fancybox": 'static/jquery.fancybox.pack/jquery.fancybox.pack',
        "jedate": 'static/jedate/jedate',
        "public": 'site/crossbbcg/pc/default/js/public',
        "cart": 'site/crossbbcg/pc/default/js/cart',
        "layer": 'static/layer-v3.0.3/layer',
        "ZeroClipboard": 'static/ZeroClipboard/ZeroClipboard',
        "ajaxupload": 'static/js/ajaxupload',
        "baidu": 'http://bdimg.share.baidu.com/static/api/js/share',
        "checkout": 'site/crossbbcg/pc/default/js/checkout',
        "copy": 'site/crossbbcg/pc/default/js/copy',
        "laydate": '/static/laydate/laydate',
        
        
        // js语言只剩下上面四个，等待页面套数据
        //会员模块
        "fenxiao": 'site/member/pc/default/js/fenxiao',
        "orderDetail": 'site/member/pc/default/js/orderDetail',
        "aftersalesDetail": 'site/member/pc/default/js/aftersalesDetail',
        "favor": 'site/member/pc/default/js/favor',
        "address": 'site/member/pc/default/js/address',
        "account": 'site/member/pc/default/js/account',
        "passport": 'site/member/pc/default/js/passport',
        "gt": 'site/member/pc/default/js/gt',
        "member": 'site/member/pc/default/js/member',
        "memberComment": 'site/member/pc/default/js/memberComment',
        "seinfoset": 'site/member/pc/default/js/seinfoset',
        "AlterMobile": 'site/member/pc/default/js/AlterMobile'
    },
    shim: {
        'jquery': {
            exports: '$'
        },
        'checkout': {
            deps: ["jquery", 'layer', 'public','ajaxupload']
        },
        'ajaxupload': {
            deps: ['jquery']
        },
         'fenxiao': {
            deps: ['public']
        },
		'brand':{
　　　　　　deps: ['public']
　　　　},
　　　　'help':{
　　　　　　deps: ['public']
　　　　},
        'ZeroClipboard': {},
        'copy': {
            deps: ['jquery', 'ZeroClipboard']
        },
        'memberComment': {
            deps: ["jquery",'ajaxupload']
        },
        'AlterMobile': {
            deps: ['jquery','layer']
        },
        'jedate': {
            deps: ["jquery"]
        },
        'laydate': {
            deps: ["layer"]
        },
        'seinfoset': {
            deps: ["jedate",'ajaxupload']
        },
        'orderDetail': {
            deps: ["jquery", 'layer', 'public']
        },
        'aftersalesDetail': {
            deps: ["jquery", 'layer', 'public']
        },
        'passport': {
            deps: ["jquery", 'public']
        },
        'address': {
            deps: ["jquery", 'layer', 'public','ajaxupload']
        },
        'account': {
            deps: ["jquery", 'layer', 'public']
        },
        'lazyload': {
            deps: ["jquery"]
        },
        'dialog': {
            deps: ["jquery"]
        },
        'jqzoom': {
            deps: ["jquery"]
        },
        'fancybox': {
            deps: ["jquery"]
        },

        'layer': {
            deps: ["jquery"]
        },

        'baidu': {},
        'public': {
            deps: ["jquery", 'lazyload', 'carouFredSel', 'layer']
        },
        'cart': {
            deps: ["jquery"]
        },
        'product': {
            deps: ["jquery", 'jqzoom', 'carouFredSel', 'fancybox']
        },
        'member': {
            deps: ["jquery", 'layer','ajaxupload']
        },
        'index': {
            deps: ["jquery"]
        },
        'country': {
            deps: ["public"]
        },
        'goodsList': {
            deps: ["jquery"]
        },
        'carouFredSel': {
            deps: ["jquery"]

        },
        'gt': {
            deps: ["jquery"]

        },
        'favor': {
            deps: ["jquery"]

        }
    }
});

require(RequireParam.BaseScript)


