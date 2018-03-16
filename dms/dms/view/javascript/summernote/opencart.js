$(document).ready(function() {
	// Override summernotes image manager
	$('.summernote').each(function() {
		var element = this;
		
		$(element).summernote({
			disableDragAndDrop: true,
			height: 300,
			emptyPara: '',
			toolbar: [
				['style', ['style']],
				['font', ['bold', 'underline', 'clear']],
				['fontname', ['fontname']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				['table', ['table']],
				['insert', ['link', 'image', 'video']],
				['view', ['fullscreen', 'codeview', 'help']]
			],
			buttons: {
    			image: function() {
					var ui = $.summernote.ui;

					// create button
					var button = ui.button({
						contents: '<i class="note-icon-picture" />',
						tooltip: $.summernote.lang[$.summernote.options.lang].image.image,
						click: function () {
							$('#modal-image').remove();
							$.ajax({
								url: 'index.php?route=common/multifilemanager&token=' + getURLVar('token'),
								dataType: 'html',
								beforeSend: function() {
									$('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
									$('#button-image').prop('disabled', true);
								},
								complete: function() {
									$('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
									$('#button-image').prop('disabled', false);
								},
								success: function(html) {
									$('body').append('<div id="modal-image" class="modal">' + html + '</div>');
									
									$('#modal-image').modal('show');
									
									$('#modal-image').delegate('a.thumbnail', 'click', function(e) {
										e.preventDefault();
										$(element).summernote('insertImage', $(this).attr('href'));						
										$('#modal-image').modal('hide');
									});
									
									$('#modal-image').delegate('#btn_mutil_img_add', 'click', function(e) {
										e.preventDefault();
										var _arrUrl = [],
											_temp = [],
											_arrInd = [];
										$('input[name="path[]"]').each(function(index){
												var _this = $(this),
													_href = _this.parent().siblings('.thumbnail').attr('href');
												if(_this.prop('checked') || _this.prop('checked') == 'checked'){
													if(_href != undefined){
														var _num = _this.parent().siblings('.thumbnail').find('img').attr('title'),
														_num = _num.substr(0,_num.indexOf('.'));
														$('body').append('<img src="'+_href+'" width="100%" style="display:none;"/>');
														_arrInd.push(_num);
														_arrUrl.push(_href);
														_temp.push(0);
													}	
												}									
										});
										_arrInd.sort();
										for(var i=0,l=_arrInd.length;i<l;i++){
											for(var j=0;j<l;j++){
												if(_arrUrl[i].indexOf(_arrInd[j])>0){
													_temp[j] =_arrUrl[i];
												}
											}
										}
										setTimeout(function(){
											for(var m=0,len=_temp.length;m<len;m++){
												$(element).summernote('insertImage', _temp[m]);
											}	
										},2000);			
										$('#modal-image').modal('hide');
									});
									
									
								}
							});						
						}
					});
				
					return button.render();
				}
  			}
		});
	});
	
});
