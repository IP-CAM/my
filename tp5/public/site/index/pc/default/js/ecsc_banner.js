$(function(){
	//首页banner轮播
	var $top = $(".banner_top"),
		$btn = $(".banner_btn"),
		$mascot = $(".banner_mascot"),
		$ecsc_desc = $(".ecsc_desc"),
		movePara=[{top:110,opacity:1},{bottom:10,opacity:1},{top:-49,opacity:1}],
		resetStyle=[{top:-50,opacity:0},{bottom:-90,opacity:0},{top:-231}];
	window.onload = function fn1(){
		$top.css(resetStyle[0]);
		$btn.css(resetStyle[1]);
		$mascot.css(resetStyle[2]);	
		$('.banner1').stop(true,false).animate({opacity:1},2000);
		$ecsc_desc.stop(true,false).animate({opacity:1},500);
		setTimeout(fn2,100);
	}
	function fn2(){
		var z = 0;
		function animate(){
			var obj = $(".plat");
			var width = obj.width();
			var height = obj.height();
			var y =(1200-(width*z/100))/2;
			if (z > 100)
			{
				return false;
			}
			else
			{
				obj.css("left", y);
				obj.find("img").css("width", z+"%");
				obj.css("opacity",(z)/100);
			}
			z++
			setTimeout(animate,10);
		}
		animate();
		setTimeout(fn3,1000);
	}
	function fn3(){
		var s = 0;
		function animate(){
			var obj = $(".banner_tp");
			var width = obj.width();
			var height = obj.height();
			var y =(1200-(width*s/100))/2+11;
			if (s > 100)
			{
				return false;
			}
			else
			{
				obj.css("left", y);
				obj.find("img").css("width", s+"%");
				obj.css("opacity",(s)/100);
			}
			s++
			setTimeout(animate,10);
		}
		animate();
		setTimeout(fn4,700);
	}
	function fn4(){
		var fn = function(){
			$top.stop(true,false).animate(movePara[0],1000);
			$btn.stop(true,false).animate(movePara[1],1000);
		}
		fn();
		setTimeout(fn5,700);
	}
	function fn5(){
		var fn = function(){
			$mascot.stop(true,false).animate(movePara[2],500);
		}
		fn();
		setTimeout(fn6,700);
	}
	function fn6(){
		var fn = function(){
			$(".shengming").stop(true,false).animate({opacity:1},500);
		}
		fn();
	}
	
});