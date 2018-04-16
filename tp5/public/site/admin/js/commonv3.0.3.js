$(function(){
	var layer_time = 2000; //弹出层显示时间
	var shade_level = 0.3;	//透明度
	
	function noPointerEvents (element) {
		$(element).bind('click', function (evt) {
			this.style.display = 'none';
			var x = evt.pageX, y = evt.pageY,
			under = document.elementFromPoint(x, y);
			this.style.display = '';
			evt.stopPropagation();
			evt.preventDefault();
			$(under).trigger(evt.type);
    	});
	}
	
	//Random Number
	function getRandom(){
        var n = 6;
		return Math.floor(Math.random()*n+1);
    }
	
	noPointerEvents ("dropdown")
	
	var topindex = parent.layer.getFrameIndex(window.name);
	$('input[name="reset"]').click(function(){
		parent.layer.close(topindex);
	});
	
	$('input[name="submit"]').click(function(){
		var that = this;
		var form = $(that).closest('form');
		var target = $(that).attr('url');
		var query = form.serialize();

		$.post(target,query).success(function(data){
				if (data.code==1) {
                    parent.layer.msg(data.msg, {icon:1, time: layer_time ,shade: 0.3}, function(){
						if(data.url){
							parent.location.href=data.url;
						}else{
                            parent.layer.close(topindex);
							//parent.location.reload();
						}
					});
                }else{
                    parent.layer.msg(data.msg, {icon:2, time: layer_time ,shade: 0.3}, function(){
						if(data.url){
							parent.location.href=data.url;
						}
					});
                }
        });
     	return false;
	})

	//Check ALL
	$(".check-all").click(function(){
		$(".ids").prop("checked", this.checked);
	});
	$(".ids").click(function(){
		var option = $(".ids");
		option.each(function(i){
			if(!this.checked){
				$(".check-all").prop("checked", false);
				return false;
			}else{
				$(".check-all").prop("checked", true);
			}
		});
	});

	//Only letter
	$('.onlyletter').on('keyup',function(){
		$(this).val($(this).val().replace(' ','_'));
		$(this).val($(this).val().replace(/[^\w =&#_-]/ig,''));
	})

	//Only letter
	$('.onlyurl').on('keyup',function(){
		$(this).val($(this).val().replace(/[^\w .:\/=&#_-]/ig,''));
	})

	//Only number
	$('.onlynumber').on('keyup',function(){
		$(this).val($(this).val().replace(/[^\.\d]/g,''));
		$(this).val($(this).val().replace('.',''));
	})

	//Only number
	$('.sorts').on('keyup',function(){
		$(this).val($(this).val().replace('.',''));
		$(this).val($(this).val().replace(/[^\.\d]/g,''));
	})

	//Only Tel
	$('.onlytel').on('keyup',function(){
		$(this).val($(this).val().replace(/[\s]/g,'-'));
		$(this).val($(this).val().replace(/[^\d|-]/g,''));

	})

	//Only currency
	$('.onlycurrency').on('keyup',function(){
		$(this).val($(this).val().replace(/[^\.\d]/g,''));
		$(this).val($(this).val().replace('-',''));
	})

	//Only letter replace _
	$('.to_').on('keyup',function(){
		$(this).val($(this).val().replace(/[\s]/g,'_'));
	})

	//Only letter replace _
	$('.tod').on('keyup',function(){
		$(this).val($(this).val().replace(/[\s|，]/g,','));
	})

	//Not Chinese
	$('.notzh').on('keyup',function(){
		var str=$(this).val();
		var i=0;
		while(i<str.length)
		{
			if(str.charCodeAt(i)>127)//According to character coding
			{
				str=str.replace(str[i],"");
				i=0;
			}else{
				++i;
			}
		}
		$(this).val(str)
	})

	/*$(".table > tbody >tr").click(function(){
		var that = $(this);
		var checkbox = that.find("input[type=checkbox]");
		if( checkbox.length > 0){
			if(checkbox.eq(0).is(':checked')){
				checkbox.eq(0).prop({checked:false}).removeClass('choosed');
			}else{
				checkbox.eq(0).prop({checked:true}).addClass('choosed');
			}
		}
		return false;
	});*/

	$(".edit").attr({
		'data-width':$('.add:first').attr('data-width'),
		'data-height':$('.add:first').attr('data-height'),
		'data-showbar':$('.add:first').attr('data-showbar')
	});

	$(".disabled").on("click",function(){
		return false;
	})

	$("body").keyup(function(e) {
	  var ev = window.event || e;
	  var code = ev.keyCode || ev.which;
	  if (code == 27) {
		parent.layer.close(parent.layer.getFrameIndex(window.name));
	  }
	});

    $('.ajax-get').on('click', function () {
	//General edit content call
		var that = $(this);
		var url = that.attr('href');
		var msg = that.attr('data-layer');
		var target = that.attr('href') ? that.attr('href') : that.attr('data-href');
		var title = that.attr('data-title')?that.attr('data-title') : that.attr('title');
		var bar = that.attr('data-showbar') == 1 ? 1:0 ;
		var postion = that.attr('data-postion');
        var wait = that.attr('data-wait');
		var left = that.offset().left;
		var top = that.offset().top;
        //start 新增：ajax弹窗，并POST数据时使用
        var target_form = that.attr('target-form');
        var query = $('.'+target_form).serialize();
        //end 新增：ajax弹窗，并POST数据时使用
        var icon = that.hasClass('warning') ? 0 : (that.hasClass('ok') ? 6 : 3);
        if ($(this).hasClass('colum') ) {
            boxw = that.attr('data-width')? that.attr('data-width') +'px': '540px';
            boxh = that.attr('data-height')? that.attr('data-height') +'px': '500px';
            bar  = 1;
        }else{
            var boxw = that.attr('data-width')? that.attr('data-width') +'px': ($(window).width() * 0.75) +'px';
            var boxh = that.attr('data-height')? that.attr('data-height') +'px': ($(window).height() * 0.85) +'px';
            boxw = boxw.indexOf('%') != -1 ?boxw.replace('px',''):boxw ;
            boxh = boxh.indexOf('%') != -1 ?boxh.replace('px',''):boxh ;
        }

		if(postion){
			offset_top = '';
			offset_left = '';
		}else{
			offset_top = top + 10  + 'px';
			offset_left = left - 300 + 'px';
		}

		if ($(this).hasClass('confirm') ) {
			layer.confirm(
				msg,
				{icon: icon,
				shift:getRandom(),
				title: [
						title,
						"border:none; background:rgb(202, 134, 64);font-size: 15px;font-weight:bold;color:#fff;"
					   ],
                btnAlign: 'c',
				btn: ['Ok','Cancel'],
				},
				function(index){
					$.get(target).success(function(data){
                        layer_time = wait ? wait * 1000 : layer_time ;
						if(data.code == 1){
							layer.msg(data.msg, {icon:1, time: layer_time ,shade: shade_level}, function(){
								if(data.url){
									location.href=data.url;
								}else{
									location.reload();
								}
							});
						}else{
							layer.msg(data.msg, {icon:2, time: layer_time ,shade: shade_level}, function(){
                                if(data.url)
                                {
                                    location.href=data.url;
                                }
							});
						}
					});
					//layer.close(index);
			});
        }else{
            if(target_form != undefined){
                $.post(target, query).success(function(data){
                    if(query == '' || query == undefined){
                        layer.msg(data.msg, {icon:0, time: layer_time ,shade: shade_level});
                        return false;
                    }

                    layer.open({
                        type: 2,
                        shift:getRandom(),
                        skin:'layui-layer-lan',
                        title: bar == 1 ? title : false,
                        shadeClose: false,
                        shade: [0.5, '#000'],
                        area: [boxw, boxh],
                        content: url
                    });
                });
            }else{
                layer.open({
                    type: 2,
                    shift:getRandom(),
                    skin:'layui-layer-lan',
                    title: bar == 1 ? title : false,
                    shadeClose: false,
                    shade: [0.5, '#000'],
                    area: [boxw, boxh],
                    content: url
                });
            }
        }
		return false;
	})

	//通用操作类调用
	$('.ajax-post').click(function(){
		var that = $(this);
		var url = that.attr('href');
		var msg = that.attr('data-layer')? that.attr('data-layer') : that.attr('title');
		var title = that.attr('title');
		var target = that.attr('href');
		var target_form = that.attr('target-form');
		var query = $('.'+target_form).serialize();
		var pattern = new RegExp("[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）&;|{}【】‘；：”“'。，、？↓+-]")
		var current_msg = that.text().replace(pattern,'');

		if ( $(this).hasClass('confirm') ) {

			layer.confirm(
				msg,
				{icon: 3,
				shift:getRandom(),
				title: [
						title,
						"border:none; background:rgb(202, 134, 64);font-size: 15px;font-weight:bold;color:#fff;"
					   ],
                btnAlign: 'c',
				btn: ['Ok','Cancel'],
				},
				function(index){
					layer.close(index);
					$.post(target,query).success(function(data){
						if(query == '' || query == undefined){
							layer.msg(data.msg, {icon:0, time: layer_time ,shade: shade_level});
							return false;
						}

						if(data.code == 1){
							layer.msg(data.msg, {icon:1, time: layer_time ,shade: shade_level}, function(){
								if(data.url){
									location.href=data.url;
								}else{
									location.reload();
								}
							});
						}else{
							layer.msg(data.msg, {icon:2, time: layer_time ,shade: shade_level}, function(){
								if(data.url){
									location.href=data.url;
								}
							});
						}
					});
			});
        }else if ($(this).hasClass('export')){
            var form=$("<form>");//定义一个form表单
            form.attr("style","display:none");
            form.attr("target","");
            form.attr("method","post");
            form.attr("action",target);
            $('.'+target_form).each(function (i,e) {
                var input1=$("<input>");
                input1.attr("type","hidden");
                input1.attr("name","ids[]");
                input1.attr('value',$(e).val());
                form.append(input1);
            });
            $("body").append(form);//将表单放置在web中
            form.submit();//表单提交
            form.remove();//表单销毁
		} else {
            $.post(target,query).success(function(data){
                if(query == '' || query == undefined){
                    layer.msg(data.msg, {icon:0, time: layer_time ,shade: shade_level});
                    return false;
                }

                if(data.code == 1){
                    layer.msg(data.msg, {icon:1, time: layer_time ,shade: shade_level}, function(){
                        if(data.url){
                            location.href=data.url;
                        }else{
                            location.reload();
                        }
                    });
                }else{
                    layer.msg(data.msg, {icon:5, time: layer_time ,shade: shade_level}, function(){
                        if(data.url){
                            location.href=data.url;
                        }
                    });
                }
            });
        }
        return false;
    })

	//清空操作
	$('.ajax-clear').click(function(){
	var that = $(this);
	var target = that.attr('href');
	var target_form = $(this).attr('target-form');
	var query = $('.'+target_form).serialize()
		$.post(target, query).success(function(data){
			if(data.code == 1){
				layer.msg(data.msg, {icon:6, time: layer_time ,shade: shade_level}, function(){
					if (! that.hasClass('no-refresh') ) {
						if(data.url){
							location.href=data.url;
						}else{
							location.reload();
						}
					}
				});
			}else{
				layer.msg(data.msg, {icon:2, time: layer_time ,shade: shade_level}, function(){
					if(data.url){
						location.href=data.url;
					}
				});
			}
		});
		return false;
	})

	//回车提交事
	$('.sorts').keydown(function(event){
		var keyValue = event.charCode || event.which || event.keyCode;
		if(keyValue == 13) {
			if($('#sort').length > 0){
				$('#sort').click();
			}else{
				return false;
			}
		}
	})

	//禁用启用操作
	$('.ajax-able').click(function(){
		var that = $(this);
		var target = that.attr('href');
		var info = that.attr('data-doing');
		var target_form = $(this).attr('target-form');
		var query = $('.'+target_form).serialize();
		var enable_span = that.attr('data-enable-span');
		var disable_span = that.attr('data-disable-span');
		var data_enabled = that.find("img").attr("data-enabled");
		var data_disabled = that.find("img").attr("data-disabled");
		$.get(target,query).success(function(data){
			if(data.code == 1){
                if(enable_span != undefined){
                    if(that.find("span").text() == enable_span){
                        that.find("span").text(disable_span).removeClass("badge-green").addClass("badge-gray");
                        that.attr("href", target.replace("disable", "enable"));
                    }else{
                        that.find("span").text(enable_span).removeClass("badge-gray").addClass("badge-green");
                        that.attr("href", target.replace("enable", "disable"))
                    }
                }else{
                    if(that.find("img").attr("src") == data_enabled){
                        that.find("img").attr("src", data_disabled);
                        that.attr("href", target.replace("disable", "enable"));
                    }else{
                        that.find("img").attr("src", data_enabled);
                        that.attr("href", target.replace("enable", "disable"));
                    }
                }
			}else{
                var wait = parseInt(data.wait) * 1000;
				layer.msg(data.msg, {icon:2, time: wait ,shade: shade_level}, function(){
					if(data.url != 'javascript:history.back(-1);'){
						location.href=data.url;
					}
				});
			}
		});
		return false;
	})

    //上传 $(".upload").click(function(){
    $("body").on('click','.upload',function(){

	    var that    = $(this);
		var title   = that.attr("data-title") ? that.attr("data-title") : that.attr("title")
		var oldurl  = that.attr("url") + "?wname=" + window.name;
		var url     = oldurl.replace(/\?/g, "&").replace(/\&/, "?");
		var w = '710px';
		var h = '455px';

		parent.layer.open({
			type: 2,
			/*title:false,*/
			title: [
					title,
					"border:none; background:rgb(202, 134, 64);font-size: 15px;font-weight:bold;color:#fff;"
				],
			shadeClose: false,
			shade: [0.5, '#000'],
			area: [w, h],
			content: url
		});
	});

    // 替换成on $('.upimg_cancel').click(function(){
    $(document).on('click','.upimg_cancel',function(){
	   $(this).parent().find("img").attr("src",$('#preview').attr("no-image"));
	   $(this).parent().find("input").val('');
	});

    //图片预览
    $(".preview").click(function () {
        var that    = $(this);
        var img     = (function () {
            var v = $('#' + that.attr('data-src')).val();
            if(v == '')
            {
                layer.msg('First Upload !', {icon:2, time: layer_time ,shade: shade_level});
                return false;
            }
            return v;
        })();
        var mypath  = (function () {
            var viewPath = $('#' + that.attr('data-src')).attr('data-upload');
            if(viewPath == undefined)
            {
                return $('.upload').attr('data-upload');
            }
            return viewPath;
        })();

        var width   = that.attr('data-width');
        var height  = that.attr('data-height');
        var area    = that.attr('data-area');
        var realimg = (function () {
            var Exp  = new RegExp(/http(s)?:\/\/([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?/);
            return Exp.test(img) ? img : mypath + '/' + img;
        })();

        layer.open({
            type: 1,
            title: false,
            closeBtn: 1,
            area: area + 'px',
            skin: 'layui-layer', //没有背景色
            shadeClose: true,
            content: '<div style="width:'+ width +'px; height:'+ height +'px;"><img src="' + realimg + '"></div>'
        });
    })
	
	$("#sch-search").click(function(){
		var url = $(this).attr('url');
        var status = $(document).hasClass("sch-status") ? $(".sch-status").val():"";
        var query_obj= $(".search-form input").filter(function(index) {
            return $(this).val() != '';
        });//筛选为空的项 
        var query = query_obj.serialize();
        if(status != ''){ 
            query = 'status=' + status + "&" + query; 
        }
        if( url.indexOf('?')>0 ){ 
            url += '&' + query;
        }else{
            url += '?' + query;
        }
		window.location.href = url;
	});
	
	/**顶部警告栏*/
	var top_alert = $('.alert');
	window.updateAlert = function (text,c) {
		text = text||'default';
		c = c||false;
		if ( text!='default' ) {
            top_alert.find('.alert-content').text(text);
			if (top_alert.hasClass('block')) {
			} else {
				top_alert.addClass('block').slideDown(200);
				// content.animate({paddingTop:'+=55'},200);
			}
		} else {
			if (top_alert.hasClass('block')) {
				top_alert.removeClass('block').slideUp(200);
				// content.animate({paddingTop:'-=55'},200);
			}
		}
		if ( c!=false ) {
            top_alert.removeClass('alert-error alert-warning alert-validation alert-success').addClass(c);
		}
	};
	
})

function highlight_subnav(cla,url){
	$('.'+cla+' a').each(function(i){
		if($('.'+cla+' a').length>0){
			var thisurl= $(this).attr('href');
			if(thisurl.indexOf(url) == 0 ) $(this).addClass('active').siblings().removeClass('active');
		}
	});
}
 
//获取URL各参数
function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]); return null;
}

//Auto Load
function addLoadEvent(func){ 
	var oldonload=window.onload; 
	if(typeof window.onload!='function'){ 
		window.onload=func; 
	}else{ 
		window.onload=function(){ 
			oldonload(); 
			func(); 
		} 
	} 
}

// 修改排序
function sort(url,ids,sort){
    $.ajax({
        url:url,
        type:"post",
        data:{'ids':ids,'sort':sort},
        dataType:"json",
        cache: false,
        time:3000,
        success:function(data){

        },
        error:function(){
            that.html('{:lang("Ver_err")}');
        }
    });
}

	
