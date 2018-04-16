$(function(){
	//首页导航滑动
	var moveNav=function(o){
		var f=$("."+o.f),a=f.find("."+o.a);
		f.css({position:"relative"});
		var moveDiv=function(w,l,a,b){
			var div=$("<div class='wrap-line'></div>");
			f.append(div);
			if(b){
				div.addClass("active");
			}
			div.css({position:"absolute",left:l,width:w});
			addEvent(w,l,a,div,b);
		}
		
		var addEvent=function(w,l,a,div,b){
			a.each(function(){
				$(this).hover(function(){
					if(b){
						div.removeClass("active");
					}
					var w2=$(this).outerWidth();
					var l2=$(this).position().left;
					if(o.w == true){
						w2= $(this).outerWidth()/2;	
						l2 = $(this).position().left+w2/2;
					}
					div.stop(true,false).animate({left:l2,width:w2});
				},function(){
					if(b){
						div.stop(true,false).animate({left:l,width:w},function(){
							div.addClass("active");
						});
					}
					else{
						div.stop(true,false).animate({left:l,width:w});
					}
				});
			});
		}
		
		a.each(function(i){
			if($(this).hasClass("current")){
				var w=$(this).outerWidth();
				var l=$(this).position().left;
				if(o.w == true){
					w = $(this).outerWidth()/2;
					l = $(this).position().left +w/2;
				}
				if(i==0){
					moveDiv(w,l,a,true);
				}else{
					moveDiv(w,l,a);
				}
			}
		});
	}
	moveNav({
		f:"header_nav",
		a:"channel"
	});
	moveNav({
		f:"nav",
		a:"channel",
		w:true
	});
});
$(function(){
	var winWidth = $(window).width();
	$(".hidden-box").css({"width":winWidth});
	$(window).resize(function(){
		winWidth = $(window).width();
		$(".hidden-box").css({"width":winWidth});
	})
	$(".has-child").hover(function(){
		var widht = $(".ecsc_logo").outerWidth();
		var left = $(this).position().left + widht;
		$(".hidden-box").css({"left":-left});
		$(this).find(".hidden-box").stop(true,false).animate({
			height:"show",
			opacity:1
		},100);
	},function(){
		$(this).find(".hidden-box").stop(true,false).animate({
			height:"hide",
			opacity:0
		},100);
	});
});