function goTop() {
	$('body,html').animate({
		scrollTop: 0
	}, 500);
}
$('.pay-item').click(function(){
    $(this).siblings().removeClass('current');
    $(this).addClass('current');
});

//全局动画加载
var public_slide = $('[data-carouFredSel]')
public_slide.each(function(index, item) {
	var _this = $(this);
	var type = _this.attr('data-type');
	if(type == 'full') {
		//全屏轮播
		var carouFredSel_config = {
			prev: _this.find('.prev'),
			next: _this.find('.next'),
			mousewheel: true,
			items: 1,
			direction: 'left', //效果默认left  ‘left , right , up , down’
			auto: {
				play: true, //自动播放
				pauseDuration: 5000 //间隔时间
			},
			scroll: {
				items: 1, //滚动个数
				easing: 'swing', //缓存效果 默认linear : 'linear , swing , quadratic , cubic , elastic'
				duration: 500, //速度
				pauseOnHover: true,
				onBefore: function() {
					var pos = $(this).triggerHandler('currentPosition');
					_this.find('.slide-page').find('span').removeClass('selected');
					_this.find('.slide-page').find('span').eq(pos).addClass('selected');
				}
			}
		};
		_this.find('.slide-page span').each(function(i) {
			$(this).click(function() {
				_this.find('.slide-content').trigger('slideTo', [i, 0, true]);
				return false;
			});
		})
	} else if(type = "group") {

		var carouFredSel_config = {
			prev: _this.find('.prev'),
			next: _this.find('.next'),
			items: 5,
			circular: false,
			infinite: false,
			direction: 'left', //效果默认left  ‘left , right , up , down’
			auto: {
				play: false, //自动播放
				pauseDuration: 5000
			},
			scroll: {

				easing: 'swing', //缓存效果 默认linear : 'linear , swing , quadratic , cubic , elastic'
				duration: 500, //速度
				pauseOnHover: true,
				onBefore: function() {
					var pos = $(this).triggerHandler('currentPosition');
					_this.find('.slide-page').find('span').removeClass('selected');
					_this.find('.slide-page').find('span').eq(pos).addClass('selected');
				}
			}
		};

	};
	var pam = _this.attr('data-carouFredSel')
	if(pam) {
		pam = eval('(' + pam + ')')
		carouFredSel_config = $.extend(true, carouFredSel_config, pam);
	}

	if(carouFredSel_config.items < _this.find('.slide-content > .slide-item').length) {
		_this.find('.slide-content').carouFredSel(carouFredSel_config);
	}

})
//左侧分类切换显示隐藏
if($('.left-cat').find('a.act').length == 0 && $('.left-cat').find('.cat2-all').length > 0) {
	$('.left-cat').find('.cat2-all').eq(0).addClass('current')
}
$('.left-cat').find('.cat2-all').each(function(index) {
	var item = $(this);
	if(item.find('a.act').length) {
		item.addClass('current')
	}
	item.find('.cat2-title').on('click', function() {
		if(item.hasClass('current')) {
			item.removeClass('current');

		} else {
			item.addClass('current');
		}

	})
})

var scroll = function(event, scroller) {
	var k = event.wheelDelta ? event.wheelDelta : -event.detail * 10;
	scroller.scrollTop = scroller.scrollTop - k;
	return false;
}
$("img.lazy").lazyload({
	effect: "fadeIn",
	skip_invisible: false
});
$("img.imglazy").lazyload({
	effect: "fadeIn",
	skip_invisible: false
});
$('.ly-search').on('click', '.ly-search-select em', function() {
	this.p = $(this).parents('.ly-search');
	var action = $(this).data('action');
	var text = $(this).text();
	this.p.find('form').attr('action', action);
	this.p.find('dd').fadeOut(100);
	this.p.find('dt span').text(text);
	$(this).addClass('act').siblings().removeClass('act')
});
$('.ly-search-select').hover(function() {
	this.p = $(this).parents('.ly-search');
	console.log(this.p.find('dd'))
	this.p.find('dd').fadeIn(100);
}, function() {
	this.p = $(this).parents('.ly-search');
	this.p.find('dd').fadeOut(100);
});

// 搜索记录隐藏
$(".ly-search .close").on('click', function() {
	$('.ly-search .search-results').hide()
});

$(document).on("click", function(e) {
	var target = $(e.target);
	if(target.closest(".ly-search").length == 0 || target.closest(".rec-results").length > 0) {
		$('.search-results').hide();
	}
})
//删除搜索记录
function search_remove(key) {

	var e = window.event;
	//获取元素
	var obj = e.target || e.srcElement;
	// var url = $(obj).data('url');
	var url = $('.'+key).find('i').data('url');
	console.log(url);

	$.ajax({
		type: 'get',
		url: url,
		dataType: 'json',
		success: function() {
			$("." + key).css("display", "none");
		}
	});

}
//显示搜索记录
$('.ly-search input[name=like]').focus(function() {
	this.p = $(this).parents('.ly-search');
	this.p.find('.search-results').show();

    $(this).attr('placeholder','');

}).blur(function(){
    $(this).attr('placeholder',$(this).data('default'));
});

// 头部搜索栏 合并到public.js
$('.ly-search button[type="submit"]').click(function(e) {
	this.p = $(this).parents('.ly-search');
	var like = $.trim(this.p.find('input[name=like]').val());
	if(like == '') {
	    _that = $('.ly-search input[name=like]');
        _that.val(_that.data('default'));
		//e.preventDefault();
		//window.location.href = this.p.find('form').attr('action');
	}
});

//动画参数
var animateParam = {
	time: 300,
	easing: 'swing'

};
/*
 * 右侧工具条操作
 *
 * */
/*右侧工具条函数*/
var sub_domain_status = $('#sub-domain-status').data('value');
var toolbarParam = {
	is_showbar: false,
	currentItem: null,
	prevItem: null,
	clickItem: ['mui-mbar-tab-cart', 'mui-mbar-tab-brand', 'mui-mbar-tab-favor', 'mui-mbar-tab-foot', 'mui-mbar-tab-top'],
	mouseItem: ['mui-mbar-tab-cart', 'mui-mbar-tab-qrcode'],
	showMinLogin: function(href) {
		$.ajax({
			type: "post",
			url: href,
            area: ['600px', '310px'],
			dataType: "html",
			success: function(data) {
                if(sub_domain_status){
                    var topindex = parent.layer.getFrameIndex(window.name);
                    layer.open({
                        'skin': 'layer-ext-blue',
                        type: 1,
                        area: ['380', '430px'],
                        scrollbar: false,
                        title: false, //$('#js_member_center').text(),
                        maxmin: false,
                        anim: 0,
                        shadeClose: true,
                        shade: [0.3, '#333333'],
                        content:  data,
                        success: function(item, index) {
                            $('#min_login_form').validateForm($('#min-login-btn'));

                            $("#min-login-btn").click(function(e) {
                                var url = $(this).data('url2');
                                var _lname = $("#username").val();
                                var _lpwd = $("#password").val();
                                var request_data = {
                                    name: _lname,
                                    password: _lpwd
                                };
                                $.post(url, request_data, function(res) {
                                    if(res.code == 1) {
                                        //登录成功，跳转页面
                                        if(res.url) {
                                            // window.location.href = res.url;
                                            // window.location.reload();
                                        }
                                    } else {
                                        layer.msg(res.msg, {
                                            skin: 'layer-ext-blue',
                                            icon: 0,
                                            time: 2000,
                                            shade: 0.3
                                        }, function() {
                                            if(res.url) {
                                                //window.location.href = res.url;
                                            }
                                        });
                                    }
                                });
                            });
                            /* 极验证 star
                             var handlerEmbed = function(captchaObj) {
                             $("#min-login-btn").click(function(e) {
                             var validate = captchaObj.getValidate();
                             var geetest_challenge = $('input[name="geetest_challenge"]').val();
                             var geetest_validate = $('input[name="geetest_validate"]').val();
                             var geetest_seccode = $('input[name="geetest_seccode"]').val();
                             if(!validate) {
                             $("#notice")[0].className = "show";
                             setTimeout(function() {
                             $("#notice")[0].className = "hide";
                             }, 2000);
                             e.preventDefault();
                             return false;
                             }

                             var url = $(this).data('url');
                             var _lname = $("#username").val();
                             var _lpwd = $("#password").val();
                             var request_data = {
                             name: _lname,
                             password: _lpwd,
                             geetest_challenge: geetest_challenge,
                             geetest_validate: geetest_validate,
                             geetest_seccode: geetest_seccode
                             };

                             $.post(url, request_data, function(res) {
                             if(res.code == 1) {
                             //登录成功，跳转页面
                             if(res.url) {
                             window.location.href = res.url;
                             }
                             } else {
                             // 登录错误
                             layer.msg(res.msg, {
                             skin: 'layer-ext-blue',
                             icon: 0,
                             time: 2000,
                             shade: 0.3
                             }, function() {
                             if(res.url) {
                             window.location.href = res.url;
                             }
                             });
                             captchaObj.reset(); // 调用该接口进行重置
                             }
                             });
                             });
                             captchaObj.appendTo("#embed-captcha");
                             captchaObj.onReady(function() {
                             $("#wait")[0].className = "hide";
                             });
                             };
                             require(['gt'], function() {
                             var gt_url = $('#embed-captcha').data('url');
                             if(gt_url) {
                             $.ajax({
                             // 获取id，challenge，success（是否启用failback）
                             url: gt_url, // 加随机数防止缓存
                             type: "get",
                             data: {
                             't': (new Date()).getTime()
                             },
                             dataType: "json",
                             success: function(data) {
                             // 使用initGeetest接口
                             // 参数1：配置参数
                             // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
                             initGeetest({
                             width: '100%',
                             gt: data.gt,
                             challenge: data.challenge,
                             new_captcha: data.new_captcha,
                             product: "float", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                             offline: !data.success, // 表示用户后台检测极验服务器是否宕机，一般不需要关注
                             lang: data.lang
                             // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
                             }, handlerEmbed);
                             }
                             });
                             }
                             });
                             极验证 end */
                        }
                    });
                }else{
                    layer.open({
                        'skin': 'layer-ext-blue',
                        type: 1,
                        area: ['380', '430px'],
                        scrollbar: false,
                        title: false, //$('#js_member_center').text(),
                        maxmin: false,
                        anim: 0,
                        shadeClose: true,
                        shade: [0.3, '#333333'],
                        content:  eval('('+data+')'),
                        success: function(item, index) {
                            $('#min_login_form').validateForm($('#min-login-btn'));

                            $("#min-login-btn").click(function(e) {
                                var url = $(this).data('url');
                                var _lname = $("#username").val();
                                var _lpwd = $("#password").val();
                                var request_data = {
                                    name: _lname,
                                    password: _lpwd
                                };
                                $.post(url, request_data, function(res) {
                                    if(res.code == 1) {
                                        //登录成功，跳转页面
                                        if(res.url) {
                                            window.location.href = res.url;
                                        }
                                    } else {
                                        // 登录错误
                                        layer.msg(res.msg, {
                                            skin: 'layer-ext-blue',
                                            icon: 0,
                                            time: 2000,
                                            shade: 0.3
                                        }, function() {
                                            if(res.url) {
                                                window.location.href = res.url;
                                            }
                                        });
                                    }
                                });
                            });
                            /* 极验证 star
                             var handlerEmbed = function(captchaObj) {
                             $("#min-login-btn").click(function(e) {
                             var validate = captchaObj.getValidate();
                             var geetest_challenge = $('input[name="geetest_challenge"]').val();
                             var geetest_validate = $('input[name="geetest_validate"]').val();
                             var geetest_seccode = $('input[name="geetest_seccode"]').val();
                             if(!validate) {
                             $("#notice")[0].className = "show";
                             setTimeout(function() {
                             $("#notice")[0].className = "hide";
                             }, 2000);
                             e.preventDefault();
                             return false;
                             }

                             var url = $(this).data('url');
                             var _lname = $("#username").val();
                             var _lpwd = $("#password").val();
                             var request_data = {
                             name: _lname,
                             password: _lpwd,
                             geetest_challenge: geetest_challenge,
                             geetest_validate: geetest_validate,
                             geetest_seccode: geetest_seccode
                             };

                             $.post(url, request_data, function(res) {
                             if(res.code == 1) {
                             //登录成功，跳转页面
                             if(res.url) {
                             window.location.href = res.url;
                             }
                             } else {
                             // 登录错误
                             layer.msg(res.msg, {
                             skin: 'layer-ext-blue',
                             icon: 0,
                             time: 2000,
                             shade: 0.3
                             }, function() {
                             if(res.url) {
                             window.location.href = res.url;
                             }
                             });
                             captchaObj.reset(); // 调用该接口进行重置
                             }
                             });
                             });
                             captchaObj.appendTo("#embed-captcha");
                             captchaObj.onReady(function() {
                             $("#wait")[0].className = "hide";
                             });
                             };
                             require(['gt'], function() {
                             var gt_url = $('#embed-captcha').data('url');
                             if(gt_url) {
                             $.ajax({
                             // 获取id，challenge，success（是否启用failback）
                             url: gt_url, // 加随机数防止缓存
                             type: "get",
                             data: {
                             't': (new Date()).getTime()
                             },
                             dataType: "json",
                             success: function(data) {
                             // 使用initGeetest接口
                             // 参数1：配置参数
                             // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
                             initGeetest({
                             width: '100%',
                             gt: data.gt,
                             challenge: data.challenge,
                             new_captcha: data.new_captcha,
                             product: "float", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                             offline: !data.success, // 表示用户后台检测极验服务器是否宕机，一般不需要关注
                             lang: data.lang
                             // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
                             }, handlerEmbed);
                             }
                             });
                             }
                             });
                             极验证 end */
                        }
                    });
                }

            }
        });
	},
	showbar: function(w, _this) {
		var css = {
			'width': w + 'px'
		};
		if(!this.is_showbar) {
			css.right = -(w - 35) + 'px';
		}
		//显示左侧工具条
		$('.mui-mbar').css(css).stop().animate({
			'right': '0px'
		}, animateParam.time, animateParam.easing);

	},
	hidebar: function() {
		//关闭左侧工具条
		this.is_showbar = false;
		$('#ly_toolbar').find('.mui-mbar-tab-sel').removeClass('mui-mbar-tab-sel');
		$('.mui-mbar').stop().animate({
			'right': -($('.mui-mbar').width() - 35) + 'px',
		}, animateParam.time, animateParam.easing);
	},
	showCart: function() {
		this.itemAnimationStart($('.mui-mbar-plugin-cart'));
		this.requestData($('.mui-mbar-plugin-cart'));
	},
	showFoot: function() {
		this.itemAnimationStart($('.mui-mbar-plugin-foot'));
		this.requestData($('.mui-mbar-plugin-foot'));
	},

	showBrand: function() {
		this.itemAnimationStart($('.mui-mbar-plugin-brand'));
		this.requestData($('.mui-mbar-plugin-brand'));
	},
	showFavor: function() {
		this.itemAnimationStart($('.mui-mbar-plugin-favor'));
		this.requestData($('.mui-mbar-plugin-favor'))

	},
	requestData: function(_this) {
		_this.find('.mui-mbar-plugin-bd').html('<div class="mui-mbar-plugin-load"></div>');
		var url = _this.attr('data-url');
		// TODO购物车
		//window.location.href=url;
		$.ajax({
			url: url,
			type: "get",
			dataType: "html",
			complete: function(){
			    if(_this.hasClass('mui-mbar-plugin-cart')){
                    minChecked(); // 重置购物车中商品的勾选状态
                }
            },
            success: function(data) {
				_this.find('.mui-mbar-plugin-bd').html(eval('(' + data + ')'));
			}
		})
	},
	itemAnimationStart: function(item) {
		if(this.currentItem) {
			this.currentItem.css({
				'z-index': '999998',
				'top': 0
			}).addClass('mui-mbar-plugin-scaleDown').siblings().css({
				'z-index': '999997',
				'visibility': 'hidden'
			})
		}
		var css = {
			'z-index': '999999',
			'height': $(window).height() + 'px',
			'top': $(window).height() + 'px',
			'visibility': 'visible'
		};
		if(!this.is_showbar) {
			css.top = 0 + 'px';
		}
		this.currentItem = item;
		item.find('.mui-mbar-plugin-bd').css('height', ($(window).height() - 35) + 'px');
		item.css(css).removeClass('mui-mbar-plugin-scaleDown');
		if(this.is_showbar) {
			item.stop().animate({
					'top': '0px'
				},
				animateParam.time,
				animateParam.easing
			);
		}
		this.is_showbar = true;
	}
};
//右侧工具条事件绑定
$('#ly_toolbar').on('mouseover', '.mui-mbar-tab', function() {
	var is_true = false;
	var _this = $(this);
	$.each(toolbarParam.mouseItem, function(i, v) {
		if(_this.hasClass(v)) {
			is_true = true;
		}
	});
	if(is_true) {
		$(this).addClass('mui-mbar-tab-hover');
		//二维码执行
		if($(this).hasClass('mui-mbar-tab-qrcode')) {
			$(this).find('.mui-mbar-qrcode-img').show().stop().animate({
				right: '35px',
				opacity: 1
			}, animateParam.time, animateParam.easing);
		}

	} else {
		$(this).addClass('mui-mbar-tab-hover').find('.mui-mbar-tab-tip').show().stop().animate({
			right: '35px',
			opacity: 1
		}, animateParam.time, animateParam.easing);
	}
}).on('mouseout', '.mui-mbar-tab', function() {
	if($(this).hasClass('mui-mbar-tab-qrcode')) {
		$(this).find('.mui-mbar-qrcode-img').stop().animate({
			right: '70px',
			opacity: 0
		}, animateParam.time, animateParam.easing, function() {
			$(this).hide();
		});
	}
	$(this).removeClass('mui-mbar-tab-hover').find('.mui-mbar-tab-tip').stop().animate({
		right: '70px',
		opacity: 0
	}, animateParam.time, animateParam.easing, function() {
		$(this).hide();
	});
}).on('click', '.mui-mbar-plugin-hd-close', function() {
	toolbarParam.hidebar();
}).on('click', '.mui-mbar-tab', function(e) {
	var _this = $(this);
	if(_this.hasClass('mui-mbar-tab-sel')) {
		toolbarParam.hidebar();
		_this.removeClass('mui-mbar-tab-sel');
	} else {
		var is_true = false;
		$.each(toolbarParam.clickItem, function(i, v) {
			if(_this.hasClass(v)) {
				is_true = true;
			}
		});
		if(is_true) {

			if($(this).hasClass('mui-mbar-tab-cart')) {
				toolbarParam.showbar(315);
				toolbarParam.showCart();
			} else if($(this).hasClass('mui-mbar-tab-foot')) {
				toolbarParam.showbar(270);
				toolbarParam.showFoot();
			} else if($(this).hasClass('mui-mbar-tab-brand')) {
				toolbarParam.showbar(270);
				toolbarParam.showBrand();
			} else if($(this).hasClass('mui-mbar-tab-favor')) {
				toolbarParam.showbar(270);
				toolbarParam.showFavor();
			} else if($(this).hasClass('mui-mbar-tab-top')) {
				goTop();
				return false;
			}
			_this.addClass('mui-mbar-tab-sel').siblings().removeClass('mui-mbar-tab-sel');
		}
	}

}).on('click', '.clear-item', function() {
	/* 清空用户浏览足迹 */
	var url = $(this).data('url');
	$.ajax({
		url: url,
		type: 'post',
		dataType: 'json',
		success: function(data) {
			if(data.code) {
				toolbarParam.showbar(270);
				toolbarParam.showFoot();
			} else {
				layer.msg(data.msg, {
					skin: 'layer-ext-blue',
					icon: 0,
					time: 2000,
					shade: 0.3
				}, function() {
					window.location.href = data.url;
				});

			}
		}
	});
}).on('click', '#carts_checkout', function() {
	// 提交订单 获取商品选中状态的id
	var items = [];
	var url = $(this).data('url');
	$('input[name="items[]"]:checked').each(function() {
		items.push($(this).val()); //向数组中添加元素
	});

	if(items.length === 0) {
		parent.layer.msg($('#js_cart_please_choose').text(), {
			skin: 'layer-ext-blue',
			icon: 0,
			time: 2000,
			shade: 0.3
		}, function() {});
	} else {
		// ajax 跳转到订单页面  items 提交购物车中选中的商品id，数组
		window.location.href = url;
	}
}).on('click', '.tm-mcDel', function() {
	// 删除商品
	var url = $(this).data('url');
	var _that = $(this);
	$.ajax({
		url: url,
		type: 'post',
		dataType: 'json',
		success: function(data) {
			// 删除成功
			if(data['code']) {
				_that.parent().parent().remove();
				minSelected();
			} else {
				// 删除失败
				toolbarParam.hidebar();
			}
		}
	});
}).on('click', '#ElectCart', function() {
	var choose = $(this).is(':checked');
	if(choose == true) {
		$('.min-cat input[type="checkbox"]').attr('checked', true);
	} else {
		$('.min-cat input[type="checkbox"]').attr('checked', false);
	}
	minSelected();
}).on('click', '.min-cat input[name="items[]"]', function() {
	minSelected();
	minChecked();
}).on('click', '.seller-check', function() {
	// 店铺的选中状态，改变店铺商品的选中状态
	var choose = $(this).is(':checked');
	if(choose == true) {
		$(this).parents('.item-box').find('input[name="items[]"]').attr('checked', true);
	} else {
		$(this).parents('.item-box').find('input[name="items[]"]').attr('checked', false);
	}
	minChecked();
	minSelected();
}).on('click', '.btn-flat', function() {
	minCartNum($(this));
	minSelected();
});

// 更新购物车 总价，总重量，总件数，总税收，选中件数  cart.js
function minSelected() {
	var items = [];
	$('.min-cat input[name="items[]"]:checked').each(function() {
		items.push($(this).val());
	});
	var url = $('#changeSelected').val();

	$.ajax({
		type: 'post',
		url: url,
		data: {
			'items': items
		},
		dataType: 'json',
		success: function(data) {
			// 如果购物车中没有商品了
			if($('.min-cat input[name="items[]"]').length === 0) {
				toolbarParam.showbar(315);
				toolbarParam.showCart();
			} else {
				$('#all_selected').text(data.all_selected);
				$('#all_weight').text(data.all_weight);
				$('#all_price').text(data.all_price);
				$('#all_tax').text(data.all_tax);
				update_cart_num(data.all_count);
			}
		}
	});
}

// 改变购物车中商品的选中状态 cart.js
function minChecked() {
	$('.item-box .b').each(function() {
		var input_l = $(this).find('input[name="items[]"]').length;
		var checked_l = $(this).find('input[name="items[]"]:checked').length;
		if(input_l === checked_l) {
			$(this).parent('.item-box').children('.t').find('input[type="checkbox"]').attr('checked', true);
		} else {
			$(this).parent('.item-box').children('.t').find('input[type="checkbox"]').attr('checked', false);
		}

	});

	var seller_input = $('.seller-check').length;
	var seller_checked_input = $('.seller-check:checked').length;
	if(seller_input === seller_checked_input) {
		$('.all-check').attr('checked', true);
	} else {
		$('.all-check').attr('checked', false);
	}
}

// 修改商品数量
function minCartNum(el) {

	var ipt = el.parent().find('.action-quantity-input'),
		num = parseInt(ipt.text()),
		cart_id = parseInt(ipt.data('cart-id')),
		url = el.parent().find('.action-quantity-input').data('url');
	var max = parseInt(ipt.attr('max')),
		min = parseInt(ipt.attr('min'));

	if(el.hasClass('btn-increase')) num++;
	if(el.hasClass('btn-decrease')) num--;

	if(!/^\d+$/.test(num)) {
		num = min;
	} else if(num > max) {
		num = max;
		popup($('#js_cart_more').text() + max + $('#js_cart_jian').text());
	} else if(num < min) {
		num = min;
		popup($('#js_cart_least').text() + min + $('#js_cart_jian').text());
	}

	var request_data = {
		cart_id: cart_id,
		num: num
	};
	// 购物车数不能为0
	if(num) {
		$.ajax({
			type: 'post',
			url: url,
			data: request_data,
			dataType: 'json',
			success: function(json) {

				if(json['redirect']) {
					window.location.href = json['redirect'];
				} else if(json['subtotal']) {
					ipt.text(num);
				}

			}
		});
	}
}

$('body').on('click', function(e) {
	if($('#ly_toolbar').find('.mui-mbar-tab-sel').length && $(e.target).parents('#ly_toolbar').length == 0) {
		toolbarParam.hidebar();
	}
});

//加入购物车
function setQuantity(el, flag) {
	//加减按钮的处理
	var ipt = el.parent().find('.action-quantity-input'),
		max = parseInt(ipt.attr('max')),
		min = parseInt(ipt.attr('min')),
		val = parseInt(ipt.val());

	switch(flag) {
		case 1:
			if(!/^\d+$/.test(val))
				ipt.val(min);
			else if(val > min)
				ipt.val(val - 1);
			else if(val == min)
				popup($('#js_cart_least').text() + min + $('#js_cart_jian').text());
			break;
		case 2:
			if(val < max)
				ipt.val(+val + 1);
			else if(val == max)
				popup($('#js_cart_more').text() + max + $('#js_cart_jian').text());
			break;
		case 3:
			if(!/^\d+$/.test(val)) {
				ipt.val(min);
			} else if(val > max) {
				popup($('#js_cart_more').text() + max + $('#js_cart_jian').text());
				ipt.val(max);
			} else if(val < min) {
				popup($('#js_cart_least').text() + min + $('#js_cart_jian').text());
				ipt.val(min);
			}
			break;
	}

};

function popup(msg) {
	var tpl = $('<div class="popup">' + msg + '</div>').fadeIn().appendTo(document.body);
	var width = tpl.width();
	tpl.css('margin-left', -(width / 2) + 'px');
	var timer = setTimeout(function() {
		tpl.remove();
	}, 3000);
};
$('.addcat-item').on('click', '.btn-flat', function(e) {
	var el = $(e.srcElement),
		n = 0;
	if(!el.hasClass('btn-flat')) return;
	if(el.hasClass('btn-increase')) n = 2;
	if(el.hasClass('btn-decrease')) n = 1;
	setQuantity(el, n);
}).on('change', '.action-quantity-input', function() {
	setQuantity($(this), 3);
}).on('click', '.btn-addcart', function() {
	// 商品id，购买数量，可选sku
	var num = $(this).parents('.addcat-item').find('.action-quantity-input').val(),
		item_id = $(this).parents('.addcat-item').find('.action-quantity-input').attr('itemId');

	var url = $(this).attr('data-url');

	// 判断是产品页面或搜索页面
	var validate = true;
	if($(this).hasClass('check')) {
		var choose_sku = $('input[name=choose_sku]').val();

		// 判断是否选择了选项
		if(choose_sku === '') {
			validate = false;
		}

		var request_data = {
			item_id: item_id,
			num: num,
			choose_sku: choose_sku
		};
	} else {
		var request_data = {
			item_id: item_id,
			num: num
		};
	}

	if($(this).hasClass('buy-btn')) {
		if($(this).hasClass('check')) {
			var request_data = {
				item_id: item_id,
				num: num,
				choose_sku: choose_sku,
				buy_now: true
			};
		} else {
			var request_data = {
				item_id: item_id,
				num: num,
				buy_now: true
			};
		}
	}

	if(validate) {
		$.ajax({
			type: 'post',
			url: url,
			data: request_data,
			dataType: 'json',
			success: function(json) {
				if(json['redirect']) {
					window.location.href = json['redirect'];
				} else if(json['code'] == 0) {
					popup(json['msg']);
				} else if(json.num) {
					popup($('#js_add_cart_success').text());
					update_cart_num(json.num);
				}

			}
		});
	} else {
		parent.layer.msg($('#js_choose_sku').text(), {
			skin: 'layer-ext-blue',
			icon: 0,
			time: 2000,
			shade: 0.3
		}, function() {

		});
	}
});
//更新购物车数量
function update_cart_num(cart_num) {
	if(cart_num) {
		$('.cart_num').html(cart_num);
	} else {
		$.ajax({
			type: 'post',
			url: RequireParam.UpdateCartUrl,
			dataType: 'json',
			success: function(data) {
				$('.cart_num').html(data);
			}
		})
	}
}
//表单验证
$.fn.validateForm = function(btn, fun) {
	var self = this;
	var _this = $(this);
	self.Init = {
		showsms: function(item) {
			if(item.attr('success-show')) {
				_this.find('[name=' + item.attr('success-show') + ']').parents('.input-line').show()
			}
		},
		hidesms: function(item) {
			if(item.attr('success-show')) {
				_this.find('[name=' + item.attr('success-show') + ']').parents('.input-line').hide().remove('error-triggered edit')
			}
		},
		check: function() {
			_this.find('[required]').trigger('blur');
			if(_this.find('.error-triggered').length || $.isFunction(fun)) {
				return false
			} else {
				return true
			}
		},
		validateForm: function() {
			var self_obj = this;
			_this.find('[required]').each(function() {

				var $this = $(this);
				var ajax_reg = true;
				$this.parents('.input-line').find('.icon-reset').click(function() {
					$this.attr('value', '')
					$this.trigger('blur')
				})
				$this.off('focus').off('blur');
				$this.on('focus', function() {
						$this.parents('.input-line').removeClass('error-triggered').addClass('edit');
						ajax_reg = true;
					})
					.on('blur', function() {

						//优先验证为空
						if(!$.trim($this.val()) && $this.parents('.input-line').css('display') != 'none') {
							$this.parents('.input-line').addClass('error-triggered empty').removeClass('edit')
								.find('.input-error').html('<i class="iconfont icon-jinggao"></i>' + $this.data('empty'));
							return false;
						}
						//验证重复密码
						if($this.data('repeat') && $this.parents('.input-line').css('display') != 'none') {
							var repeat_input = $("[name=" + $this.data('repeat') + "]")
							if(repeat_input.val() != $this.val() && repeat_input.val() != "") {
								if($this.data('repeaterror')) {
									$this.parents('.input-line').addClass('error-triggered empty').removeClass('edit')
										.find('.input-error').html('<i class="iconfont icon-jinggao"></i>' + $this.data('repeaterror'));
								}
							} else {
								repeat_input.parents('.input-line').removeClass('error-triggered edit');
								$this.parents('.input-line').removeClass('error-triggered edit');

							}

						}
						if($this.data('regex') && $this.parents('.input-line').css('display') != 'none') {
							var reg = new RegExp($this.data('regex'));

							if(reg.test($.trim($this.val())) === false) {
								$this.parents('.input-line').addClass('error-triggered').removeClass('empty edit')
									.find('.input-error').html('<i class="iconfont icon-jinggao"></i>' + $this.data('error'));
								self_obj.hidesms($this);
								return false;
							}
							if($this.data('ajax') && ajax_reg) {
								var req_data = {}
								req_data[$this.attr('name')] = $this.val()
								$.ajax({
									url: $this.data('ajax'),
									type: 'post',
									dataType: 'json',
									data: req_data,
									success: function(data) {
										if(data.code > 0) {
											$this.parents('.input-line').removeClass('error-triggered edit');
											ajax_reg = false;
											self_obj.showsms($this)

										} else {
											self_obj.hidesms($this)
											$this.parents('.input-line').addClass('error-triggered').removeClass('empty edit')
												.find('.input-error').html('<i class="iconfont icon-jinggao"></i>' + data.msg);
										}

									}
								})

							}
						}

					});
			});
			_this.submit(function(e) {

				return self.Init.check()
			})

		}

	};

	btn.click(function() {

		if(btn.attr('type') != 'submit' || $.isFunction(fun)) {
			//判断验证通过 并且没有传入自定义函数,并且按钮的type为submit 执行表单提交时事
			_this.find('[required]').trigger('blur');
		}
	})
	self.Init.validateForm()

}

// 通用倒计时，包括倒计时所在容器，倒数秒数，显示方式，回调。
function countdown(element, options) {
	var self = this;
	options = $.extend({
		start: 60,
		secondOnly: false,
		callback: null
	}, options || {});
	var t = options.start;
	var sec = options.secondOnly;
	var fn = options.callback;
	var d = +new Date();
	var diff = Math.round((d + t * 1000) / 1000);
	this.timer = timeout(element, diff, fn);
	this.stop = function() {
		clearTimeout(self.timer);
	};

	function timeout(element, until, fn) {
		var str = '',
			started = false,
			left = {
				d: 0,
				h: 0,
				m: 0,
				s: 0,
				t: 0
			},
			current = Math.round(+new Date() / 1000),
			data = {
				d: '天',
				h: '时',
				m: '分',
				s: 's'
			};

		left.s = until - current;

		if(left.s < 0) {
			return;
		} else if(left.s == 0) {
			fn && fn();
		}
		if(!sec) {
			if(Math.floor(left.s / 86400) > 0) {
				left.d = Math.floor(left.s / 86400);
				left.s = left.s % 86400;
				str += left.d + data.d;
				started = true;
			}
			if(Math.floor(left.s / 3600) > 0) {
				left.h = Math.floor(left.s / 3600);
				left.s = left.s % 3600;
				started = true;
			}
		}
		if(started) {
			str += ' ' + left.h + data.h;
			started = true;
		}
		if(!sec) {
			if(Math.floor(left.s / 60) > 0) {
				left.m = Math.floor(left.s / 60);
				left.s = left.s % 60;
				started = true;
			}
		}
		if(started) {
			str += ' ' + left.m + data.m;
			started = true;
		}
		if(Math.floor(left.s) > 0) {
			started = true;
		}
		if(started) {
			str += ' ' + left.s + data.s;
			started = true;
		}

		$(element).html(str);
		return setTimeout(function() {
			timeout(element, until, fn);
		}, 1000);
	}
}
//滚动定位
function ScrollToLocate(id) {
	var sctop = id.offset().top;
	$(window).scroll(function() {
		var scrolls = $(this).scrollTop();
		if(scrolls > sctop) {
			if(window.XMLHttpRequest) {
				id.css({
					position: "fixed",
					top: 0
				}).addClass("fixed");
			} else {
				id.css({
					top: scrolls
				});
			}
		} else {
			id.css({
				position: 'static',
				top: sctop
			}).removeClass("fixed");
		}
	});
}
$('.attention-weixin').hover(function(){
    if($(this).parent().children('div').length>0){
        $(this).parent().children('div').show().stop().animate({
            opacity: 1
        }, 300, 'swing');
    }
},function(){
    if($(this).parent().children('div').length>0) {
        $(this).parent().children('div').stop().animate({
            opacity: 0
        }, 300, 'swing', function () {
            $(this).hide();
        });
    }
});