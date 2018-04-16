$(function(){
	function Options(id,cName,model){
		this.id=$("#"+id);
		this.li=this.id.find("."+cName).find("li");
		this.model=this.id.find("."+model);
		this.init();
	}
	Options.prototype.init=function(){
		var that=this;
		this.model.eq(0).css("display","block");
		this.li.eq(0).addClass("active");
		this.li.click(function(){
			var index=that.li.index(this);
			that.li.removeClass("active");
			that.li.eq(index).addClass("active");
			that.model.css("display","none");
			that.model.eq(index).css("display","block");
		});	
	}
	
	
	function Options2(){
		Options.apply(this,arguments);
	}
	
	Options2.prototype=new Options();
	Options2.prototype.extend=function(o){
		
		this.li.hover(function(){
			var tips=$(this).find("."+o.name);
			tips.show().stop().animate({right:10,opacity:1});
		},function(){
			var tips=$(this).find("."+o.name);
			tips.stop().animate({right:30,opacity:0},function(){
				tips.hide();
			});
		});
	}
	
	var o=new Options2("option","tit_tips","pos_wrap");
	o.extend({
		name:"clearfix"
	});
	
	
	var scrollBars=function(o){
		var f=$("."+o.f);
		
		var addEvent=function(th_is,o,num){
			var arr=["direction_up","direction_down"];
			for(var i=0;i<2;i++){
				var div=$("<div class="+arr[i]+">");
				th_is.append(div);
				
			}
			var t=0,_this=this,timer=null;
			$(".direction_down").hover(function(){
				timer=setInterval(function(){
					if(t>=num){
						clearInterval(timer);
						o.css("top",-num);
						return;
					}
					t++;
					o.css("top",-t);
				},10);
				
			},function(){
				clearInterval(timer);
			});
			$(".direction_up").hover(function(){
				timer=setInterval(function(){
					if(t<=0){
						clearInterval(timer);
						o.css("top",0);
						return;
					}
					t--;
					o.css("top",-t);
				},10);
			},function(){
				clearInterval(timer);
			});
			
			
		}
		f.each(function(i){
			var dl=$(this).children("dl"),h=dl.outerHeight();
			if(h>$(this).outerHeight()){
				var cha=h-$(this).outerHeight();
				addEvent($(this),dl,cha);
			}
			
		});
	}
	scrollBars({
		f:"pos_wrap"
	});
	
	
	var choose_habits=function(){
		var w=$(document).width(),h=$(".main_1").outerHeight();
		$(".choose_which").css({height:h});
		
	}
	choose_habits();
	
	
	
	zzs={
		getCookie:function(name){
			var cookieName=encodeURIComponent(name)+"=",
			start=document.cookie.indexOf(cookieName),
			cookieValue=null;
			
			if(start>-1){
				var end=document.cookie.indexOf(";",start);
				if(end==-1){
					end=document.cookie.length;
				}
				cookieValue=decodeURIComponent(document.cookie.substring(start+cookieName.length,end));
			}
			
			return cookieValue;
		},
		set:function(name,value,expires,path,domain,secure){
			var cookieText=encodeURIComponent(name)+"="+encodeURIComponent(value);
			if(expires instanceof Date){
				cookieText+=";expires="+expires.toGMTString();
			}
			
			if(path){
				cookieText+=";path="+path;
			}
			
			if(domain){
				cookieText+=";domain="+domain;
			}
			
			if(secure){
				cookieText+=";secure="+secure;
			}
			document.cookie=cookieText;
		
		},
		unset:function(name,path,domain,secure){
			zzs.set(name,"",new Date(0),path,domain,secure);
		}
	}
	
	var cartoon_doMove=function(){
		var d=zzs.getCookie("direction");
		
		$(".lefthand2").click(function(){
			left_layout();
		});
		
		
		$(".righthand2").click(function(){
			right_layout();
		});
		
		var left_layout=function(){
			$(".choose_which").remove();
			$(".rightPart").css({left:40});
			$(".leftPart").css({left:315});
			$(".tit_tips").css({right:300});
			//zzs.unset("direction");
		}
		
		var right_layout=function(){
			$(".choose_which").remove();
			$(".rightPart").css({left:868});
			$(".leftPart").css({left:-25});
			$(".tit_tips").css({right:-50});
			//zzs.unset("direction");
			return;
		}
		if(typeof d=="string"){
			if(d=="left"){
				left_layout();
			}else if(d=="right"){
				right_layout();
			}
		}else{
			var doMove=function(){
				var w=$(document).width();
				$(".rightHand").click(function(){
					zzs.set("direction","right",new Date(2015,1,1));
					$(".choose_which").stop(true,false).animate({left:w},function(){
						$(this).remove();
					});
				});
				
				$(".leftHand").click(function(){
					zzs.set("direction","left",new Date(2015,1,1));
					$(".choose_which").stop(true,false).animate({left:-w},function(){
						$(this).remove();
						callBack();
					});
				});
				
				var callBack=function(){
					$(".rightPart").stop(true,false).animate({left:40},"slow");
					$(".leftPart").stop(true,false).animate({left:315},"slow",function(){
						$(".tit_tips").stop(true,false).animate({right:300});
					});
				}
				
			}
			doMove();
		}
		
	}
	cartoon_doMove();
	
	var toggleClass=function(){
		var li=$(".nav_1").find("li:first");
		var fn=function(){
			li.toggleClass("tese");
			setTimeout(arguments.callee,100);
		}
		fn();
	}
	//toggleClass();
	
	var d=$(".con");
	d.hide();
	d.first().show();
	$(".nav_1 li.item a").click(function(){
		var num=$(this).parent().index();
		$('.con,.layout,.h111').hide();
		d.eq(num).show();
		$(".nav_1 li").removeClass("active");
		$(".nav_1 li").eq(num).addClass("active");
		$(window).scrollTop(0);
		//根据点击选项不同，给立即购买不同的链接
		var hrefs = [
			"http://www.runtuer.com/goods-671.html",
			"http://www.runtuer.com/goods-671.html",
			"http://www.runtuer.com/goods-671.html"
			];
		var index = $(this).parent().index();
		$("#topBuyButton").attr("href",hrefs[index]);
		//切换到bbc页面时给容器加个状态
		if(index == 1){
			$("#bbc-page").attr("current","true");
			$(".bbc-dsc .dsc-bg").removeAttr("style");
		}
	});
	//头部导航鼠标经过
	$(".nav_1 li.item").hover(function(){
		var li = $(this);
		var pleft = $(".nav_1").offset().left;
		var lileft = li.offset().left;
		var left = lileft - pleft - 26; 
		var width = li.width();
		$(".nav_1 .bottom-line").stop(true).animate({width : width + "px", left : left + "px"});
	},function(){
		if(!$(this).hasClass("active")){
			var li = $(".nav_1 li.item.active");
			var pleft = $(".nav_1").offset().left;
			var lileft = li.offset().left;
			var left = lileft - pleft - 26; 
			var width = li.width();
			$(".nav_1 .bottom-line").stop(true).animate({width : width + "px", left : left + "px"});
		}
	});
	//bbc第二部分滚动动画
	$(window).scroll(function(){
		var top = $("body").scrollTop();
		var bbc = !!$("#bbc-page").attr("current");
		if(top > 348 && bbc){
			$(".bbc-dsc .dsc-bg").animate({bottom: 0},500);
		}
	});
	//bbc 商家入驻部分 视差移动
	$('#bbcSimg').on('mousemove', function(e) {
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

	

	//bbc图片轮播滚动事件禁止冒泡
	$(".bbc-view .view-slide .bd .view-pic .img").mouseenter(function(){ 
	}).mouseleave(function(){
	});

	//
	var b=$(".BottomBox"),c=$(".BottomCon");
	var bW=$(".contact_us.on").innerWidth()+$(".some_tips.on").innerWidth()+1;
	b.width(bW);
	c.width(bW);
	$(".Icon,.close").click(function(){
		if( b.width()=="0" ){
			b.stop(true,false).animate({width:bW},500);
			$(".close").removeClass("on");
		}else{
			b.stop(true,false).animate({width:0},500);
			$(".close").addClass("on");
		}
	});
	//
	var main_1H=$(".main_1").height();
	$(".main").height(main_1H);
	//
	$('.slideTxtBox a').click(function(){
		$(window).scrollTop(0);
	});
	//
	$('.NavList').find('li a').click(function(){
		var num=$(this).parent().index();
		$(this).parents('ul').find('li').removeClass('active');
		$(this).parent('li').addClass('active');
		$('.con,.layout').hide();
		$('.layout').eq(num).show();
		$(window).scrollTop(0);
	})
	//
	//
	$('.help').hover(function(){
		$(this).find('.help_con').show();
	},function(){
		$(this).find('.help_con').hide();
	})
	//
	//
	$('.on_click').click(function(){
		$('.con,.layout,.h111').hide();
		d.eq(3).show();
		$(".nav_1 li").removeClass("active");
		$(".nav_1 li").eq(3).addClass("active");
		$(window).scrollTop(0);
	})
	$('.on_click02').click(function(){
		$('.con,.layout,.h111').hide();
		d.eq(4).show();
		$(".nav_1 li").removeClass("active");
		$(".nav_1 li").eq(4).addClass("active");
		$(window).scrollTop(0);
	})

	//demo-tab
	$(".demo .tab-kjt,.demo .bottom-kjt").click(function(){
		$(".demo").removeClass("on");
		var top = $(".demo").offset().top;
		$("body,html").animate({scrollTop: top + "px"});
	});
	$(".demo .tab-kaola,.demo .bottom-kaola").click(function(){
		$(".demo").addClass("on");
		var top = $(".demo").offset().top;
		$("body,html").animate({scrollTop: top + "px"});
	});

	//bbc view slide
	$(".bbc-view .view-slide").slide({
		effect : "fold"
	});
});