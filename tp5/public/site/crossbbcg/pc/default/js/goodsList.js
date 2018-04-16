(function($) {
	var data_req={}
	var filter_inputs={}
	var inputs=$('.ly-filter-box').data('inputs');
	$('.ly-filter-items').each(function(){
		var type=$(this).data('type');
		if(inputs[type])filter_inputs[type]=inputs[type];
		
	})
	$.each(filter_inputs,function(i,v){
			data_req[i]=v.split('_');
	})
	var html=""
	$.each(data_req,function(i,v){
		
		var name=$('[data-type='+i+']').data('name');
		var value=[];
			$.each(v,function(i2,v2){
			 value.push($('[data-type='+i+']').find('[data-id='+v2+']').text());
			});
			//只显示前3个, 多余显示...
			if(value.length>2){
				value=value.slice(0,2);
				value.push('...')
			};
		html+='<li data-type="'+i+'">'+
	              '<a class="btn-remove" title="'+$('#delete_this').text()+'">'+$('#delete_this').text()+'</a>'+
	              '<span class="label">'+name+'：</span>'+value.join(',')+
              '</li>'
	})
	$('.currently ol').html(html);
	$('.ly-block-content').on('click','li',function(){
		var type=$(this).data('type');
		var url="?";
		var len=0;
		var sj_len=0
		$.each(inputs,function(i,v){
			if(type!=i){
				len++
			}
		})
		
		$.each(inputs,function(i,v){
		
			if(type!=i){
					sj_len++
				
				if(len==sj_len){
					url+=i+'='+v
				}else{
					url+=i+'='+v+'&'
				}
				
			}
		})
		window.location.href = url;
		
	})
	
	$(window).scroll(function() {
		var win_t = $(window).scrollTop();
		if(win_t > 500) {
			$('#dingwei').addClass('hover')
		} else {
			$('#dingwei').removeClass('hover')
		}
		if(win_t > 200) {
			$('.ly-header-fixed').addClass('show')
			
		}else{
			$('.ly-header-fixed').removeClass('show');
			$('.search-results').hide('show')
		}
		
		$('[data-title]').each(function(i) {
			var span_t = $(this).offset().top;
			var span_h=$(this).height();
			if(win_t+50 >= span_t && win_t-span_t<span_h)
					$('#dingwei li').eq(i).addClass('act').siblings().removeClass('act')
		})
	})
	
	//默认显示4项筛选, 多余的在这里点击切换显示
	$('#ly-filter_lists .more-expand-area').on('click', function() {
		var _this = $(this);
		if(!_this.hasClass('act')) {
			_this.addClass('act').html('<a class="more-btn" href="javascript:void(0)">'+$(this).data('up')+'<span class="d">&nbsp;</span></a>');
			$('#ly-filter_lists .ly-filter-items').each(function(i) {

				if(i > 3) {
					$(this).show();
				}
			})
		} else {
			_this.removeClass('act').html('<a class="more-btn" href="javascript:void(0)">'+$(this).data('more')+'<span class="d">&nbsp;</span></a>');
			$('#ly-filter_lists .ly-filter-items').each(function(i) {
				if(i > 3) {
					$(this).hide();
				}
			})
		}
	})
	$('#ly-filter_lists .show-morefilter').on('click', function() {
		$(this).parents('dd').addClass('many');
		$(this).parents('dd').addClass('more').find('.show-more').addClass('show-less');
	})
	$('#ly-filter_lists .show-more').on('click', function(e) {
		$(this).toggleClass('show-less').parents('dd').toggleClass('more');
		if(!$(this).hasClass('show-less')) {
			_abolish(e)
		}
	})
	//取消选中
	$('#ly-filter_lists .abolish').on('click', _abolish);
	function _abolish(e) {
		var parent = $(e.target).parents('dd');
		parent.removeClass('many').removeClass('more').find('.show-more').removeClass('show-less');
		parent.find('.confirm').removeClass('act');
		parent.find('.current').removeClass('current');
	};
	$('#ly-filter_lists').on('click', '.many li a', function() {
		//多选状态下筛选点击时间
		var parent = $(this).parents('.many');
		$(this).parent('li').toggleClass('current');
		var checked_length = parent.find('.current').length;
		if(checked_length > 0) {
			parent.find('.confirm').addClass('act');
		} else {
			parent.find('.confirm').removeClass('act');
		}
		return false
	}).on('click', '.confirm.act', function() {
		
		//确定执行事件
        var type = $(this).parent().data('type');
        var url = $(this).parent().data('url');
        var current = $(this).parent().parent().find('.current');
        var id = '';
        current.each(function(){
            id += '_' + $(this).children('a').data('id');
        });
        if(id.substr(0,1)=='_'){
            id = id.substr(1);
        }

        if( url.indexOf('?')>0 ){
            url += '&'+type+'='+id;
        }else{
            url += '?'+type+'='+id;
        }

        window.location.href = url;
	});

    // 添加默认select类  最后合并到goodsList.js
    if($('.sort-by').find('a.selected').length == 0){
        $('.sort-by').find('a').first().addClass('selected');
    }

})(jQuery)
