<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $text_login; ?></h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<label class="control-label" for="input-email"><?php echo $entry_email; ?></label>
					<input type="text" name="email" value="" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
				</div>
				<div class="form-group">
					<label class="control-label" for="input-password"><?php echo $entry_password; ?></label>
					<input type="password" name="password" value="" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
					<a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a></div>
				<input type="button" value="<?php echo $button_login; ?>" id="button-login" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary button-login" />
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
// Login
$(document).delegate('#onepagecheckout .button-login', 'click', function() {
	$.ajax({
		url: 'index.php?route=onepagecheckout/login/save',
		type: 'post',
		data: $('#onepagecheckout .content-login :input'),
		dataType: 'json',
		beforeSend: function() {
			$('#onepagecheckout .button-login').button('loading');
		},
		complete: function() {
				$('#onepagecheckout .button-login').button('reset');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['redirect']) {
					location = json['redirect'];
			} else if (json['error']) {
				$('#onepagecheckout .content-login .panel-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

				// Highlight any found errors
				$('#onepagecheckout .content-login input[name=\'email\']').parent().addClass('has-error');
				$('#onepagecheckout .content-login input[name=\'password\']').parent().addClass('has-error');
			}
		}
	});
});
//--></script>