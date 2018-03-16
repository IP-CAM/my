
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 newsletter-text" style="padding-left:0px"><?php echo $entry_email; ?> </div>
		
		<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12"><input type="text" value="" placeholder="<?php echo $text_email; ?>" name="email" id="newsletter_email" class="form-control" /></div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 newsletter-button"><button class="button" id="button-newsletter"><?php echo $button_join; ?></a></div>


<script type="text/javascript"><!--
$('#button-newsletter').on('click', function() {
	$.ajax({
		url: 'index.php?route=extension/module/newsletter/validate',
		type: 'post',
		data: $('#newsletter_email'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-newsletter').prop('disabled', true);
			$('#button-newsletter').after('<i class="fa fa-spinner"></i>');
		},	
		complete: function() {
			$('#button-newsletter').prop('disabled', false);
			$('.fa-spinner').remove();
		},				
		success: function(json) {
			if (json['error']) {
				alert(json['error']['warning']);
			} else {
				alert(json['success']);
				
				$('#newsletter_email').val('');
			}
		}
	});	
});	
$('#newsletter_email').on('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#button-newsletter').trigger('click');
	}
});
//--></script> 