var autosizeindex = parent.layer.getFrameIndex(window.name);
	parent.layer.iframeAuto(autosizeindex);			
	var h = parent.$("#layui-layer-iframe"+autosizeindex).height() + 10;
	var oh = parent.$("#layui-layer-iframe"+autosizeindex).outerHeight() + 7;
	var t = parent.$("#layui-layer"+autosizeindex).css('top');
	var tt = parseInt(t.substr(0, t.length - 2)) + 25;
	var topoffset = ($(parent).height() - $(window).height())/2 - 30;
	parent.layer.style(autosizeindex, {height:h,top:tt + 'px'});
	parent.$("#layui-layer-iframe"+autosizeindex).css({height: oh});
	parent.$("#layui-layer"+autosizeindex).css({top: topoffset});
	