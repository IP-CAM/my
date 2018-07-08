


<?php if ($addresses && !$stores) { ?>
      <input type="hidden" name="payment_address" value="new" checked="checked" />
<?php } ?>




  <div id="payment-new" style="display: block;">
    <div class="form-group clearfix required">
      <label class="col-sm-2 control-label" for="input-payment-email"><?php echo $entry_email; ?></label>
      <div class="col-sm-10">
        <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-payment-email" class="form-control" />
      </div>
    </div>
    <div class="form-group clearfix required">
      <label class="col-sm-2 control-label" for="input-payment-telephone"><?php echo $entry_telephone; ?></label>
      <div class="col-sm-10">
        <input type="text" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $store_telphone; ?>" id="input-payment-telephone" class="form-control" style="font-size:18px; font-weight:bold; color:#333;" />
      </div>
    </div>
	
    <div class="form-group clearfix required">
      <label class="col-sm-2 control-label" for="input-payment-firstname"><?php echo $entry_firstname; ?></label>
      <div class="col-sm-10">
        <input type="text" name="firstname" value="" placeholder="<?php echo $entry_firstname; ?>" id="input-payment-firstname" class="form-control" />
      </div>
    </div>
	
	<?php if (!$stores) { ?>
    <div class="form-group clearfix<?php echo ($postcode_required ? ' required' : ''); ?>">
      <label class="col-sm-2 control-label" for="input-payment-postcode"><?php echo $entry_postcode; ?></label>
      <div class="col-sm-10">
        <input type="text" name="postcode" value="" placeholder="<?php echo $entry_postcode; ?>" id="input-payment-postcode" class="form-control" />
      </div>
    </div>
    <div class="form-group clearfix required">
      <label class="col-sm-2 control-label" for="input-ship-address-1"><?php echo $entry_address_1; ?></label>
      <div class="col-sm-10">
        <input type="text" name="address_1" value="" placeholder="<?php echo $entry_address_1; ?>" id="input-ship-address-1" class="form-control" />
      </div>
    </div>
	<?php } ?>
	
    <?php foreach ($custom_fields as $custom_field) { ?>
    <?php if ($custom_field['location'] == 'address') { ?>
    <?php if ($custom_field['type'] == 'select') { ?>
    <div class="clearfix form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
      <label class="col-sm-2 control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
      <div class="col-sm-10">
        <select name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control">
          <option value=""><?php echo $text_select; ?></option>
          <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
          <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>"><?php echo $custom_field_value['name']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <?php } ?>
    <?php if ($custom_field['type'] == 'radio') { ?>
    <div class="clearfix form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
      <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
      <div class="col-sm-10">
        <div id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>">
          <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
          <div class="radio">
            <label>
              <input type="radio" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
              <?php echo $custom_field_value['name']; ?></label>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php if ($custom_field['type'] == 'checkbox') { ?>
    <div class="clearfix form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
      <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
      <div class="col-sm-10">
        <div id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>">
          <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
          <div class="checkbox">
            <label>
              <input type="checkbox" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
              <?php echo $custom_field_value['name']; ?></label>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php if ($custom_field['type'] == 'text') { ?>
    <div class="clearfix form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
      <label class="col-sm-2 control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
      <div class="col-sm-10">
        <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
      </div>
    </div>
    <?php } ?>
    <?php if ($custom_field['type'] == 'textarea') { ?>
    <div class="clearfix form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
      <label class="col-sm-2 control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
      <div class="col-sm-10">
        <textarea name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" rows="5" placeholder="<?php echo $custom_field['name']; ?>" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control"><?php echo $custom_field['value']; ?></textarea>
      </div>
    </div>
    <?php } ?>
    <?php if ($custom_field['type'] == 'file') { ?>
    <div class="clearfix form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
      <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
      <div class="col-sm-10">
        <button type="button" id="button-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
        <input type="hidden" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="" />
      </div>
    </div>
    <?php } ?>
    <?php if ($custom_field['type'] == 'date') { ?>
    <div class="clearfix form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
      <label class="col-sm-2 control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
      <div class="col-sm-10">
        <div class="input-group date">
          <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
          <span class="input-group-btn">
          <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
          </span></div>
      </div>
    </div>
    <?php } ?>
    <?php if ($custom_field['type'] == 'time') { ?>
    <div class="clearfix form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
      <label class="col-sm-2 control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
      <div class="col-sm-10">
        <div class="input-group time">
          <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="HH:mm" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
          <span class="input-group-btn">
          <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
          </span></div>
      </div>
    </div>
    <?php } ?>
    <?php if ($custom_field['type'] == 'datetime') { ?>
    <div class="clearfix form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field" data-sort="<?php echo $custom_field['sort_order']; ?>">
      <label class="col-sm-2 control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
      <div class="col-sm-10">
        <div class="input-group datetime">
          <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
          <span class="input-group-btn">
          <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
          </span></div>
      </div>
    </div>
    <?php } ?>
    <?php } ?>
    <?php } ?>
  
	<?php if ($stores) { ?>
    <div class="form-group clearfix" <?php echo (count($stores) < 2)?'style="height:0px; overflow:hidden;"':''; ?>>
      <label class="col-sm-2 control-label" for="input-ship-zone"><?php echo $ship_zone; ?></label>
      <div class="col-sm-10">
        <select name="ship_zone" class="form-control" id="input-ship-zone">
          <!--<option value="" data=""><?php echo $text_select; ?></option>-->
          <?php foreach ($stores as $key => $store) { ?>
          <option value="<?php echo isset($store['name'][$language_id])?$store['name'][$language_id]:''; ?>" data="<?php echo $key; ?>"><?php echo isset($store['name'][$language_id])?$store['name'][$language_id]:''; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="form-group clearfix">
      <label class="col-sm-2 control-label" for="input-ship-address-1"><?php echo $ship_address; ?></label>
      <div class="col-sm-10">
        <select name="address_1" class="form-control" id="input-ship-address-1">
		  <option value=""><?php echo $text_select; ?></option>
		</select>
      </div>
    </div>
	<?php } ?>
	
	
	<?php if ($customs) { ?>
	<?php foreach ($customs as $key => $custom) { ?>
    <div class="form-group clearfix">
      <label class="col-sm-2 control-label" for="input-payment-postcode"><?php echo isset($custom['name'][$language_id])?$custom['name'][$language_id]:''; ?></label>
      <div class="col-sm-10">
	    <?php if ($custom['type'] == 'text') { ?>
        <input type="text" value="<?php echo isset($custom['value'][$language_id])?$custom['value'][$language_id]:''; ?>" placeholder="<?php echo isset($custom['name'][$language_id])?$custom['name'][$language_id]:''; ?>" class="ship-custom form-control" />
		<?php } ?>
		
	    <?php
			if ($custom['type'] == 'select') {
				$vs = explode("\n", isset($custom['value'][$language_id])?$custom['value'][$language_id]:'');
		?>
        <select class="ship-custom form-control" id="input-ship-select">
		  <?php foreach ($vs as $v) { ?>
		  <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
		  <?php } ?>
		</select>
		<?php } ?>
		
	    <?php if ($custom['type'] == 'date') { ?>
        <input type="text" id="datetimepicker<?php echo $key; ?>" value="<?php echo !empty($custom['value'][$language_id])?$custom['value'][$language_id]:date('m/d/Y', (int)time()); ?>" placeholder="<?php echo isset($custom['name'][$language_id])?$custom['name'][$language_id]:''; ?>" class="ship-custom form-control" />
		<script type="text/javascript"><!--
		$('#datetimepicker<?php echo $key; ?>').datetimepicker({
			minDate: '<?php echo date('m/d/Y', (int)time()); ?>',
			pickTime: false
		}).on('change', function() {
			w();
		});
		//--></script>
		<?php } ?>
      </div>
    </div>
	<?php } ?>
	<?php } ?>
	
	
	<?php if ($stores || $customs) { ?>
    <div class="form-group clearfix">
      <div id="input-ship-info"></div>
    </div>
	<script type="text/javascript"><!--
	var address = new Array();
	
	<?php foreach ($stores as $key => $store) { ?>
		address[<?php echo $key; ?>] = '';
		
		<?php
			foreach ($store['store'] as $v) {
			
			$address = isset($v['address'][$language_id])?addcslashes($v['address'][$language_id], '\''):'';
			$work = isset($v['work'][$language_id])?addcslashes($v['work'][$language_id], '\''):'';
		?>
		address[<?php echo $key; ?>] += '<option value="<?php echo $address; ?>" data="<?php echo $work; ?>"><?php echo $address; ?></option>';
		<?php } ?>
	<?php } ?>
	
	function w() {
		$('#input-ship-zone').parent().find('.text-danger').remove();
		$('#input-ship-zone').parent().parent().removeClass('has-error');
		$('#input-ship-address-1').parent().find('.text-danger').remove();
		$('#input-ship-address-1').parent().parent().removeClass('has-error');
		
		var html = '';
		
		if ($('#input-ship-zone').length > 0 && $('#input-ship-zone').val() != '') {
			html += $('#input-ship-zone').val() + ' ';
		}
		
		if ($('#input-ship-address-1').length > 0 && $('#input-ship-address-1').val() != '') {
			html += $('#input-ship-address-1').val() + ' ';
			
			if ($('#input-ship-address-1').find('option:selected').length > 0) {
				var work = $('#input-ship-address-1').find('option:selected').attr('data');
				
				if (work != '') {
					html += '(' + work + ')';
				}
			}
		}
		
		var custom = '';
		
		if ($('.ship-custom').length > 0) {			
			$('.ship-custom').each(function () {
				if ($(this).val() != '') {
					custom += $(this).val() + ' ';
				}
			});
			
			html += custom;
		}
		
		$('#custom').val(custom);
		
		$('#input-ship-info').attr('class', 'well well-sm').html(html);
		
		if ($('#input-ship-zone').length > 0 && $('#input-ship-zone').val() == '') {
			$('#input-ship-zone').after('<div class="text-danger"><?php echo $error_shipping_zone; ?></div>');
			highlight();
		} else if ($('#input-ship-address-1').length > 0 && $('#input-ship-address-1').val() == '') {
			$('#input-ship-address-1').after('<div class="text-danger"><?php echo $error_address; ?></div>');
			highlight();
		}
	}
	
	$('#input-ship-zone').on('change', function() {
		var key = $(this).find('option:selected').attr('data');
		
		if (key != '') {
			var html  = '';
				html += address[key];
			$('#input-ship-address-1').html(html);
		}
		
		w();
	});
	
	$('#input-ship-zone').trigger('change');
	
	$('#input-ship-address-1').on('change', function() {
		w();
	});
	
	$('#input-ship-select').on('change', function() {
		w();
	});
	//--></script>
	<?php } ?>
	
  </div>
<script type="text/javascript"><!--
// Sort the custom fields
$('#collapse-payment-address .form-group[data-sort]').detach().each(function() {
	if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#collapse-payment-address .form-group').length) {
		$('#collapse-payment-address .form-group').eq($(this).attr('data-sort')).before(this);
	} 
	
	if ($(this).attr('data-sort') > $('#collapse-payment-address .form-group').length) {
		$('#collapse-payment-address .form-group:last').after(this);
	}
		
	if ($(this).attr('data-sort') < -$('#collapse-payment-address .form-group').length) {
		$('#collapse-payment-address .form-group:first').before(this);
	}
});
//--></script>
<script type="text/javascript"><!--
$('#collapse-payment-address button[id^=\'button-payment-custom-field\']').on('click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);
			
			$.ajax({
				url: 'index.php?route=tool/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$(node).parent().find('.text-danger').remove();;
					
					if (json['error']) {
						$(node).parent().find('input[name^=\'custom_field\']').after('<div class="text-danger">' + json['error'] + '</div>');
					}
	
					if (json['success']) {
						alert(json['success']);
	
						$(node).parent().find('input[name^=\'custom_field\']').attr('value', json['file']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});
//--></script>
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.time').datetimepicker({
	pickDate: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});
//--></script>