

(function(factory) {
    if(typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    }
    else {
        factory(jQuery);
    }
}(function($){

	function Dialog(ops){
		this.init(ops);
	}

    var dialogHtml = '<div class="ui-dialog">'+
                     '    <div class="ui-dialog-hd">'+
                     '        <span class="ui-dialog-tit"></span>'+
                     '        <a href="javascript:;" class="ui-dialog-close J_DialogClose">X</a>'+
                     '    </div>'+
                     '    <div class="ui-dialog-bd"></div>'+
                     '    <div class="ui-dialog-ft hide"><div class="ui-dialog-buttons"></div></div>'+
				     '</div>'+
                     '<div class="ui-dialog-mask"></div>';

	$.extend(Dialog.prototype, {

		init: function(ops){

			var defaultOption = {
		        title: '',
		        content: '',
		        padding: null,
		        width: null,
		        ok: null,
		        okValue: '确定',
		        cancel: null,
		        cancelValue: '取消',
		        close: null,
		        isHide: false,
		        diaclass:null
		    };

			var self  = this;
			var shell = this.shell = this.shellInit();

			ops = this.ops = $.extend(defaultOption, ops);
			ops.title && shell.find('.ui-dialog-tit').html(ops.title);
			ops.padding && shell.find('.ui-dialog-bd').css({
			    padding: ops.padding
			});

			ops.content && self.content();
		

			var $footer = shell.find('.ui-dialog-ft');

			if(ops.ok) {
				$footer.removeClass('hide');

				var $ok = $('<button type="button" class="ui-button ui-button-small">'+ ops.okValue +'</button>');

				$footer.find('.ui-dialog-buttons').append($ok);

				$ok.on('click', function(){
					if($.isFunction(ops.ok)) {
						ops.ok.call(self);
					}
				});
			}

			if(ops.cancel) {
				$footer.removeClass('hide');

				var $cancel = $('<button type="button" class="ui-button ui-button-small minor ml10">'+ ops.cancelValue +'</button>');

				$footer.find('.ui-dialog-buttons').append($cancel);

				$cancel.on('click', function(){
					

					if($.isFunction(ops.cancel)) {
						var rt = ops.cancel();
						if(rt) {
							self.close();
						}
						return;
					}

					self.close();
				});
			}

			self.positionInit();

			var $close = shell.find('.J_DialogClose');

			$close.on('click', function(){
				ops.close && $.isFunction(ops.close) && ops.close();
			    self.close();
			});
		},
		shellInit: function(){
			return $(dialogHtml).appendTo($("body"));
		},

		content: function(){
		    var $content = this.shell.find('.ui-dialog-bd');

		    $content.html(this.ops.content);
		    return this;
		},

		close: function(){
			if (this.ops.isHide) {
				this.hide();
			} else {
		    	this.shell.remove();
			}
			return this;
		},
		hide: function(){
			this.shell.hide();
			return this;
		},
		show: function(){
			this.shell.show();
			return this;
		},
		positionInit: function(){
			  this.ops.diaclass && this.shell.eq(0).addClass(this.ops.diaclass)
		    this.shell.eq(0).css({
		        marginTop: -this.shell.outerHeight()/2
		    });
		    this.ops.width && this.shell.eq(0).css({
		        width: this.ops.width,
		        marginLeft: -this.ops.width/2
		    });
		   
		  
		    return this;
		}

	});

	$.dialog = function(ops){
		return new Dialog(ops);
	}

	$.alert = function(content){

		var defaultOption = {
			ok: function(){
				this.close();
			},
			width: 400,
			padding: 20,
			content: content || ''
		}

		return $.dialog(defaultOption);

	}

	$.confirm = function(content, callback){

		var defaultOption = {
			ok: function(){
				callback && callback();
				this.close();
			},
			width: 400,
			padding: 20,
			content: content || '',
			cancel: true
		}

		return $.dialog(defaultOption);
	}

	/**
	 * notice
	 * type      @String, content, countdown
	 * content   @String
	 * countdown @
	 */

	var noticeHtml = '<div class="ui-notice"><p></p></div>';
	var noticeOption = {
		timeout: 1500,
		type: 'normal',
		content: ''
	};

	function Notice(ops){
		this.init(ops);
	}

	$.extend(Notice.prototype, {
		init: function(ops){
			var self = this;
			var ops   = this.ops   = $.extend(noticeOption, ops);
			var shell = this.shell = this.shellInit();

			var callback = function(){
				$.isFunction(ops.callback) && ops.callback();
				self.close();
			}

			this.countDown(ops.timeout, callback);

		},
		positionInit: function(){
			var width  = this.shell.outerWidth();
			var height = this.shell.outerHeight();
			this.shell.css({
				marginLeft: -width/2,
				marginTop:  -height/2
			});
		},
		shellInit: function(){
			var self = this;
			var shell = $(noticeHtml).appendTo($("body"));

			shell.find('p').text(this.ops.content);
			shell.addClass(this.ops.type);

			return shell;
		},
		countDown: function(num, callback){
			var self = this;
			num = num || 0;
			var timeout = setInterval(function(){
				num = num - 500;
				if (num <= 0) {
					callback();
					clearInterval(timeout);
				}
			}, 500);
		},
		close: function(){
			this.shell.animate({
				opacity: 0
			}, 300, function(){
				this.remove();
			});
		}
	});

	$.notice = function(type, content, countdown, callback){
		return new Notice({
			type: type || noticeOption.type,
			content: content || noticeOption.content,
			timeout: countdown || noticeOption.timeout,
			callback: callback
		});
	}

}));