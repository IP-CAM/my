//放大镜配置板块
   $('.jqzoom').jqzoom({
   	zoomType: 'standard',
   	lens: true,
   	preloadImages: true,
   	position: 'right',
   	alwaysOn: false,
   	zoomWidth: 400,
   	showEffect: true,
   	zoomHeight: 400
   });
   //tab切换
   $('.goods-tabs-top').find('li').on('click', function() {
   	var i = $(this).index()
   	$(this).addClass('act').siblings().removeClass('act')
   	$(this).parents('dl').find('.goods-tabs-body').eq(i).show().siblings('.goods-tabs-body').hide()
   })
   //评论图片放大
   $("a.grouped").fancybox({
   	'transitionIn': 'elastic',
   	'transitionOut': 'elastic',
   	'speedIn': 600,
   	'speedOut': 200,
   	'overlayShow': false
   });

   $('.ly-main ').on('click','#shuifei_link',function(){
   		layer.open({
		  type: 1 //Page层类型
		  ,area: ['950px', '600px']
		  ,title: $(this).data('title')
		  ,'skin': 'layer-ext-blue'
		  ,shade: 0.6 //遮罩透明度
		  ,maxmin: false //允许全屏最小化
		  ,anim:0//0-6的动画形式，-1不开启
		  ,content: $('#shuifei_content').html()
		});    
   	return false
   });

// 商品选项值选取,最后合并到product.js
var count_list = $('.spec-lists').length;
//console.log(count_list);// 多少个选项组
//console.log($('.spec-attr').length); // 多少个选项值
// 获取sku的库存
$('.spec-attr').on('click',function(){
    // 添加selected，移除同济元素的selected
    if($(this).hasClass('disabled'))return;
    	$('.spec-attr').removeClass('disabled')
    $(this).siblings('.spec-attr').removeClass('selected');
        $(this).toggleClass('selected');
        var act_arr_index=[]
        var rel=$(this).find('a').attr('data-rel');
   		var merge_value = '';
		var act_arr=[];
        $('.spec-lists li.selected').each(function(){
        		act_arr.push($(this).children('a').attr('data-rel'));
            merge_value += ','+$(this).children('a').attr('data-rel');
        });
        var act_key=act_arr.sort().join(',')
 		var act_item={};
        //选出库存为0的id
  		$.each(skuAll,function(k,v){
			var ls_arr=k.split(',');
			var key_arr=k.split(',').sort().join(',')
  			if(key_arr==act_key){
  				act_item=v;
  			};
			$.each(act_arr,function(k2,v2){
				if(k.indexOf(v2)>-1&& !v.validate){
				ls_arr.splice(ls_arr.indexOf(v2),1)
				act_arr_index.push(ls_arr)
				}
			})
  		})
  		//为库存为0的id加class
  		$.each(act_arr_index, function(i,v) {
  			$.each(v, function(i2,v2) {
  				$('.spec-attr').find('[data-rel='+v2+']').parent().addClass('disabled')
  			});
  		});
    // 多少个选项值被选中
    var count_selected = $('.spec-lists li.selected').length;
    if(count_selected == count_list){
        var url = $(this).parents('.spec-lists').attr('data-url');
        var item_id = $(this).parents('.spec-lists').attr('data-item_id');
 		
       	//当前选中的json
	    // console.log(act_item)
        if(merge_value.substr(0,1)==','){
            merge_value = merge_value.substr(1);
        }
        // console.log(merge_value);
        $.ajax({
            url: url,
            type:'post',
            data:{'merge_value': merge_value,'item_id':item_id},
            dataType:'json',
            success: function(data){
                if(data.quantity < 1){
//                      parent.layer.msg($('#sku_error').text(), {skin:'layer-ext-blue',icon:0, time: 2000 ,shade: 0.3}, function(){
//
//                      });
                }
                $('.goods-num em').text(data.quantity);
                $('span.price').text(data.sale_price);
                $('span.mk-price').text(data.market_price);
                $('span.tax').text(data.tax);
                $('input[name=choose_sku]').val(data.sku);
                if(data.price_rate !== 0){
                    $('.zhe').text(data.price_rate).show();
                }else{
                    $('.zhe').hide();
                }


                // sku库存，商品购买数量不大于库存量
                var max = $('#quantity_txt').data('maximum');
                if(max>data.quantity){
                    $('#quantity_txt').attr('max',data.quantity);
                    if($('#quantity_txt').val()>data.quantity){
                        $('#quantity_txt').val(data.quantity);
                    }
                }
            }
        });
    }
});

// 收藏店铺,收藏商品 最后合并到product.js
$('.attention').on('click',function(e){
    _this = $(e.target);

    var url = $(this).attr('data-url');
    $.ajax({
        url: url,
        type:'post',
        dataType:'json',
        success: function(data){
            // 收藏成功
            if (data.code==1) {
                parent.layer.msg(data.msg, {skin:'layer-ext-blue',icon:1, time: 2000 ,shade: 0.3}, function(){
                    if(_this.children('i').hasClass('icon-fav')){
                        _this.children('i.icon-fav').css("backgroundPosition","0 0");
                    }
                    if(_this.hasClass('icon-fav')){
                        _this.css("backgroundPosition","0 0");
                    }

                });
            }else{
                // 未登陆
                // toolbarParam.showMinLogin(url); 登陆小窗口

                parent.layer.msg(data.msg, {skin:'layer-ext-blue',icon:0, time: 2000 ,shade: 0.3}, function(){
                    if(data.url){
                        parent.location.href=data.url;
                    }
                });
            }

        }
    });
});

// 清空用户浏览足迹
$('.goods-ly-list').on('click', '.empty', function() {
    var url = $(this).data('url');
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data.code) {
                $('.goods-ly-list').remove();
            } else {
                layer.msg(data.msg, {
                    skin: 'layer-ext-blue',
                    icon: 0,
                    time: 2000,
                    shade: 0.3
                }, function () {
                    window.location.href = data.url;
                });

            }
        }
    });
});
/* 发货地 */
$('.region-chooser-container').on('mouseover',function(){
	$(this).find('.region-chooser-box').show();
	$(this).find('.region').addClass('active')
}).on('mouseleave',function(){
	if($(this).find('.region-edit').length){
		$(this).find('.region-edit').removeClass('region-edit')
	}else{
		$(this).find('.region-chooser-box').hide();
		$(this).find('.region').removeClass('active')
	}
});
$('.region-chooser-container .region-chooser-close').click(function(){
	$(this).parents('.region-chooser-container').find('.region-chooser-box').hide();
	$(this).parents('.region-chooser-container').find('.region').removeClass('active')
});

$('body').on('click', function(e) {
	if($(e.target).parents('.region-chooser-container').length == 0) {
		$('.region-chooser-container').find('.region-chooser-box').hide();
		$('.region-chooser-container .region').removeClass('active')
	}
});
$('.tuijian-list .tabs-top li').click(function(){
	this.index=$(this).index();
	$(this).addClass('curr').siblings().removeClass('curr');
	$('.tuijian-list .tabs-body').eq(this.index).addClass('show').siblings('.tabs-body').removeClass('show');
})
    var AreaWidget = function(a) {
    	var b = this;
    	b.options = {
    		dataUrl: "data.json",
    		select: null,
    		level: 4,
    		name: "area[]",
    		initData: null,
    		callback: function(isdata) {

    		}
    	};
    	var c = function(a) {

    			b.data = a;
    			b.nowList = [];
    			b.selectList = [];
    			b.selected = [];
    			b.selected_text = [];
    			
    			b.boxt = $('<dt class="region-tabs"></dt>');
    			b.boxb = $('<dd class="region-items-dd"></dd>');
    			b.boxw = $('<dl class="select-area"></dl>').append(b.boxt).append(b.boxb);
    			b.box.empty().append(b.boxw);
    			for(a = 0; a < b.options.level; a++) b.selectList[a] = 0 == a ? $('<div class="region-tab">'+$('#js_choose').text()+'<i></i></div>').appendTo(b.boxt).on('click', f) :$('<div style="display:none;" class="region-tab lv-' + a +'">-'+$('#js_choose').text()+'-<i></i></div>').appendTo(b.boxt).on('click', f);

    			for(a = 0; a < b.options.level; a++) b.selectList[a] = 0 == a ? $('<div style="display:none;" class="region-items lv-' + a + '"></div>').appendTo(b.boxb).on('click', 'a', d) : $('<div style="display:none;" class="region-items lv-' + a + '"></div>').appendTo(b.boxb).on('click', 'a', d);
    			var c = "";
    			$.each(b.data, function(a, d) {
    				c += "<a data-sub='"+(b.data[a].children?'true':'false')+"' value='" + b.data[a].id + "'>" + b.data[a].value + "</a>"
    			});
    			b.selectList[0].html(c).show();
    			b.nowList[0] = b.data;
    			if(b.options.initData) {
    				b.input = $('<input type="hidden" name="' + b.options.name + '" value="' + b.options.initData + '">').appendTo(b.boxb);
    				var k = b.options.initData.split(",");
    				$.each(b.selectList, function(a, b) {
    					b.attr('value', k[a]).find('a[value=' + k[a] + ']').trigger("click")
    				})
    			} else {
    				b.boxt.find('.region-tab').eq(0).addClass('selected')
    				b.input = $('<input type="hidden" name="' + b.options.name + '">').appendTo(b.box)
    			}
    		},
    		f = function() {
    			 i = $(this).index()
    			$(this).addClass('selected').siblings().removeClass('selected')
    			$('.region-items', b.boxb).eq(i).show().siblings().hide()

    		},
    		d = function() {
    			var a = $(this),c = a.index(),d = a.parent().index();
    			a.addClass('selected').siblings().removeClass('selected');
    			b.boxt.find('.region-tab').eq(d).html(a.html()+'<i></i>');
    			b.boxt.find('.region-tab').eq(d).addClass('selected').siblings().removeClass('selected')
    			if(a.data('sub')){
    				b.boxt.find('.region-tab').eq(d+1).show()
    				}else{
    				b.boxt.find('.region-tab').eq(d+1).hide()
    			}
    			a.parent().attr('value',a.attr('value'));
    			if(b.selected[d]){
    				for(var p = d ; p < b.selected.length; p++){
	    				b.selected.pop();
	    				b.selected_text.pop();
	    				$('.region-tab', b.boxt).eq(p+2).hide()
	    				if(a.data('sub'))$('.region-tab', b.boxt).eq(p+1).html('-'+$('#js_choose').text()+'-<i></i>');
    				}
    			}
    			
    			b.selected[d]=a.attr('value');
    			b.selected_text[d]=a.text();
    		
    			if(!a.data('sub') || d+1 == b.options.level) {
    				b.box.removeClass('region-edit')
    				b.input.val(b.selected.join(","));
    				var backdata = {};
	    			backdata['name'] = b.options.name;
	    			backdata['value']=b.selected;
	    			backdata['text']=b.selected_text;
    				b.callback(backdata);
    			
    			}else if(a.data('sub')) {
    				
    				b.box.addClass('region-edit')
    				a.parent().hide()
    				b.nowList[d+1] = b.nowList[d][c].children;
    				//	if("undefined" === typeof b.nowList[d])  b.nowList[d] = null, b.selectList[d].html("<li> -- </li>"), 0;
    				var g = "";
    				$.each(b.nowList[d+1], function(a, c) {
    					g += "<a data-sub='"+(c.children?'true':'false')+"' value='" + c.id + "'>" + c.value + "</a>"
    				});
    				b.selectList[d+1].show().html(g)
    				
 				
    			};
    			return false;
    		};
    	(function() {
    		b.options = $.extend(b.options,
    			a);

    		b.box = b.options.select;
    		b.callback = b.options.callback;
    		$.ajax({
    			type: "GET",
    			url: b.options.dataUrl,
    			dataType: "json",
    			success: function(a) {

    				a ? c(a) : b.box.html($('#js_region_error').text());
    			}
    		})
    	})()
    }

      new   AreaWidget({
            dataUrl:$('#region-content').data('url'),/*请求地址*/
            select: $('#region-content'),/*容器*/
            initData:"440000,440300,440304",/*默认地址 TODO 获取客户ip的对应地区代码*/
            level:6,/*最多显示等级*/
            callback:function(data){
            	//console.log(data.value.length);
            	$('.region-chooser-container .region span').html(data.text.join(" ")+'<i></i>')
                $('.region-chooser-container').trigger('mouseleave');


            	// 运费
                var city_id = 0;
                var item_id = $('#region-content').data('item_id');
                var num = $('#quantity_txt').val();
                var sku = $('input[name="choose_sku"]').val();
                if(data.value.length == 3){
                    city_id = data['value'][1];
                }else if(data.value.length < 3){
                    city_id = data['value'][0];
                }

                var request_data = {
                    item_id: item_id,
                    num : num,
                    city_id : city_id,
                    sku : sku
                }; // TODO
                var validate = true;
                var freight_url = $('#region-content').data('freight_url');
                if(validate) {
                    $.ajax({
                        type: 'post',
                        url: freight_url,
                        data: request_data,
                        dataType: 'json',
                        success: function (data) {
                            if(data.freight){
                                $('.post-age-info p').html(data.freight);
                            }
                            if(data.cross_name !== false){
                                $('#cross_name').text(data.cross_name);
                                $('#cross_name').parents('.item-info').show();
                            }else{
                                $('#cross_name').parents('.item-info').hide();
                            }

                        }
                    });
                }

            }
        });

$('.comment-tab ul li').click(function () {
    $(this).addClass('active');
    $(this).siblings().removeClass('active');
    $('#'+$(this).data('target')).show();
    $('#'+$(this).data('target')).siblings().hide();
});
