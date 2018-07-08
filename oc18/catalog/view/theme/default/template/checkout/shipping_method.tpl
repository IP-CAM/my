<p><strong><?php echo $text_shipping_zone; ?></strong></p>
<p><select name="country_id" id="input-country" class="form-control">
	<option value=""><?php echo $text_select; ?></option>
	<?php foreach ($countries as $country) { ?>
	<?php if ($country['country_id'] == $country_id) { ?>
	<option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
	<?php } else { ?>
	<option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
	<?php } ?>
	<?php } ?>
</select></p>
<p><select name="zone_id" id="input-zone" class="form-control">
	<option value=""><?php echo $text_select; ?></option>
	<?php foreach ($zones as $zone) { ?>
	<?php if ($zone['zone_id'] == $zone_id) { ?>
	<option value="<?php echo $zone['zone_id']; ?>" selected="selected"><?php echo $zone['name']; ?></option>
	<?php } else { ?>
	<option value="<?php echo $zone['zone_id']; ?>"><?php echo $zone['name']; ?></option>
	<?php } ?>
	<?php } ?>
</select></p>


<?php if ($error_warning) { ?>
<div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($shipping_methods) { ?>
<p><?php echo $text_shipping_method; ?></p>
<?php foreach ($shipping_methods as $shipping_method) { ?>
<p><strong><?php echo $shipping_method['title']; ?></strong></p>
<?php if (!$shipping_method['error']) { ?>
<?php foreach ($shipping_method['quote'] as $quote) { ?>
<div class="radio">
  <label>
    <?php if ($quote['code'] == $code || !$code) { ?>
    <?php $code = $quote['code']; ?>
    <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" checked="checked" />
    <?php } else { ?>
    <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" />
    <?php } ?>
    <?php echo $quote['title']; ?> - <?php echo $quote['text']; ?></label>
</div>
<?php } ?>
<?php } else { ?>
<div class="alert alert-danger"><?php echo $shipping_method['error']; ?></div>
<?php } ?>
<?php } ?>
<?php } ?>
<p><strong><?php echo $text_comments; ?></strong></p>
<p>
  <textarea name="comment" rows="8" class="form-control"><?php echo $comment; ?></textarea>
</p>
<div class="buttons">
  <div class="pull-right">
    <input type="button" value="<?php echo $button_continue; ?>" id="button-shipping-method" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary" />
  </div>
</div>
<script type="text/javascript"><!--
$('select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=account/account/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
			$('.fa-spin').remove();
	
			if (json['postcode_required'] == '1') {
				$('input[name=\'postcode\']').parent().parent().addClass('required');
			} else {
				$('input[name=\'postcode\']').parent().parent().removeClass('required');
			}
	
			html = '<option value=""><?php echo $text_select; ?></option>';
	
			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
					html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	
					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
						html += ' selected="selected"';
			  		}
	
			  		html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
	
			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country_id\']').trigger('change');

$('select[name=\'zone_id\']').on('change', function() {
	var country_id = $('select[name=\'country_id\']').val();
	var zone_id = this.value;
	
	if (country_id != '' && zone_id != '') {
		$.ajax({
			url: 'index.php?route=checkout/shipping_method&country_id=' + country_id + '&zone_id=' + zone_id,
			dataType: 'html',
			success: function(html) {
				$('#collapse-shipping-method .panel-body').html(html);
				
				$('#collapse-shipping-method').parent().find('.panel-heading .panel-title').html('<a href="#collapse-shipping-method" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle"><?php echo $text_checkout_payment_address; ?> <i class="fa fa-caret-down"></i></a>');
	
				$('a[href=\'#collapse-shipping-method\']').trigger('click');
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	} else {
		alert('<?php echo $error_shipping_zone; ?>');
	}
});
//--></script>
