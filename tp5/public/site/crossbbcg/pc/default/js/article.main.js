if(Private_Script) {
	RequireParam.BaseScript = RequireParam.BaseScript.concat(Private_Script);
}
require.config({
	baseUrl: RequireParam.BaseScriptPath,
	paths: {　
		"jquery": "static/js/jquery",
		"layer": 'static/layer-v3.0.3/layer',
		"carouFredSel": 'static/js/jquery.carouFredSel-6.2.1',
		"lazyload": 'static/js/jquery.lazyload',
		"article": 'site/crossbbcg/pc/default/js/article',
		"baidu": 'http://bdimg.share.baidu.com/static/api/js/share',
	},
	shim: {　　　　　　
		'jquery': {　　　　　　　　
			exports: '$'　　　　　　
		},
		'carouFredSel': {
			deps: ["jquery"]

		},
		'layer': {
			deps: ["jquery"]

		},　
		'lazyload': {
			deps: ["jquery"]

		},　
		'article': {
			deps: ["layer",'lazyload','jquery']

		},　　　　　　
		
		　　　　　　　　
	}
});

require(RequireParam.BaseScript)