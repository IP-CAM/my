//js优化滚动
(function($){
	$.fn.jScroll = function(settings){
		var settings = $.extend();
		return this.each(function(settings){
			var $this = $(this);
			var Bool=false;
			var Scrbody = $this.find(".scrollBody");
			var Scro=Scrbody.find(".scroll");
			var Scrp=Scro.find("p");
			var Scrobd=Scrbody.find(".all-list");
			var Scroul=Scrobd.find(".desc");
			var letter = Scrbody.prev();
			var Scrp_Height = Scrp.outerHeight()/2;
			var Num2=Scro.outerHeight()-Scrp.outerHeight();
			var offsetX=0;
			var offsetY=0;
		
			Scrp.mousedown(function(e){  
				Bool=true;
			});
			$(document).mouseup(function(){
				Bool=false;
			});
			$(document).mousemove(function(e){
				if(Bool){
					var top = Scro.offset().top;
					var topHeight = Scro.offset().top + Scro.outerHeight();
					var value =Scrbody.offset().top;
					var marginTop = Number(Scro.css("marginTop").replace('px',''));
					if(e.pageY>=top && e.pageY <= topHeight){
						var Num1= e.pageY - value - marginTop;
						var y = Num1 - Scrp_Height;
					}
					if(y<=1){
						Scrll(0);
						Scrp.css("top",1);
					}else if(y>=Num2){
						Scrp.css("top",Num2);
						Scrll(Num2);
						if(Scrbody.parents("#download")){
							$(".download_prompt .btn_red").removeClass("disabled");
						}
					}else{
						Scrll(y);
					}
				}
			});
			function Scrll(y){
				Scrp.css("top",y);
				Scroul.css("margin-top",-(y/(Scro.outerHeight()-Scrp.outerHeight()))*(Scroul.outerHeight()-Scrobd.height()));
			}
			function wheel(e){
				var Distance=Num2*0.1;
				var evt = e || window.event;
				var wheelDelta = evt.wheelDelta || evt.detail;
				
				//火狐浏览器禁止页面滚动轴滚动
				if (navigator.userAgent.toLowerCase().indexOf('firefox')>=0){
					if (e.preventDefault)
					e.preventDefault();
					e.returnValue = false;
				}
				if(wheelDelta == -120 || wheelDelta == 3){
					var Distances=Scrp.position().top+Distance;
					if(Distances>=Num2){
						Scrp.css("top",Num2);
						if(Scrbody.parents("#download")){
							$(".download_prompt .btn_red").removeClass("disabled");
						}
						Scrll(Num2);
					}else{
						Scrll(Distances);
					}
					return false;
				}else if (wheelDelta == 120 || wheelDelta == -3){
					var Distances=Scrp.position().top-Distance;
					if(Distances<=1){
						Scrll(0);
						Scrp.css("top",1);
					}else{
						Scrll(Distances);
					}
					return false;
				}   
			}
			
			//测试ie滚动兼容
			var isIE = !!window.ActiveXObject;
			var isIE6 =isIE&&!window.XMLHttpRequest;
            var isIE8=isIE&&!!document.documentMode;
            var isIE7=isIE&&!isIE6&&!isIE8;

			if(isIE8 || isIE7){
				if(document.getElementById("scrollBody").attachEvent){
					document.getElementById("scrollBody").onmousewheel = wheel;
					document.getElementById("scrollBody").attachEvent('DOMMouseScroll',wheel,false);
				}
			}else{
				if(document.getElementById("scrollBody").addEventListener){
					document.getElementById("scrollBody").onmousewheel = wheel;
					document.getElementById("scrollBody").addEventListener('DOMMouseScroll',wheel,false);
				}
			}
		});
	}
})(jQuery);