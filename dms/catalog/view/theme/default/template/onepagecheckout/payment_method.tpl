<?php if ($payment_methods) { ?>
<?php foreach ($payment_methods as $payment_method) { ?>
	<div class="radio">
		<label>
			<?php if ($payment_method['code'] == $code || !$code) { ?>
			<?php $code = $payment_method['code']; ?>
			<input type="radio"  name="payment_method" value="<?php echo $payment_method['code']; ?>" checked="checked" />
			<?php } else { ?>
			<input type="radio"  name="payment_method" value="<?php echo $payment_method['code']; ?>" />
			<?php } ?>
			<?php if(!empty(${'image'.$payment_method['code']})){ ?>
			<img src="<?php echo ${'image'.$payment_method['code']}; ?>"/>
			<?php } ?>
			<?php if(!empty(${'title'.$payment_method['code']})){ ?>
			<?php echo ${'title'.$payment_method['code']}; ?>
			<?php }else{ ?>
			<?php echo $payment_method['title']; ?>
			<?php } ?>
			<?php if ($payment_method['terms']) { ?>
			(<?php echo $payment_method['terms']; ?>)
			<?php } ?>
		</label>
	</div>
<?php } ?>
<?php }else{ ?>	
<?php if ($error_warning) { ?>

<div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>

<?php } ?>
<?php } ?>
<script>
$('.payment-method-content input[name=\'payment_method\'], .payment-method-content input[name=\'payment_method\']').on('change', function(){
	$.ajax({
		url: 'index.php?route=onepagecheckout/payment_method/savepayment',
		type:'post',
		data:$('.payment-method-content input[type="radio"]:checked'),
		dataType: 'json',
		success: function(json){
			$('.alert, .text-danger').remove();
			if(json['error']){
				$('.payment-method-content').before('<div class="alert alert-danger">' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
			}
			if(json['success']){
				var account_type = ($('#onepagecheckout input[name=\'account_type\']:checked').val()) ? $('#onepagecheckout input[name=\'account_type\']:checked').val() : '';
				LoadConfirmation(account_type);
			}
		}
	})
});

$(document).ready(function(){
 $('.payment-method-content input[name=\'payment_method\']:checked, .payment-method-content select[name=\'payment_method\']').trigger('change');
});
</script>