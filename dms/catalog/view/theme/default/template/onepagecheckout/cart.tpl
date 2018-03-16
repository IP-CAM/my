<?php if(!$redirect){ ?>
<?php if ($error_warning) { ?>
<div class="alert alert-danger extalert balert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
	<button type="extutton" class="close" data-dismiss="alert">&times;</button>
</div>
<?php } ?>
<div class="extcover">
<div class="exttable-responsive">
	<table class="exttable btable-bordered">
		<thead>
			<tr>
				<?php $colspan = 0; ?>
				<?php if($show_product_image) { ?>
				<td class="text-center"><?php echo $column_image; ?></td>
				<?php $colspan += 1; ?>
				<?php } ?>
				<?php if($show_product_name) { ?>
				<td class="text-left"><?php echo $column_name; ?></td>
				<?php $colspan += 1; ?>
				<?php } ?>
				<?php if($show_product_model) { ?>
				<td class="text-left"><?php echo $column_model; ?></td>
				<?php $colspan += 1; ?>
				<?php } ?>
				<?php if($show_product_quantity) { ?>
				<td class="text-left"><?php echo $column_quantity; ?></td>
				<?php $colspan += 1; ?>
				<?php } ?>
				<?php if($show_product_unit) { ?>
				<td class="text-right"><?php echo $column_price; ?></td>
				<?php $colspan += 1; ?>
				<?php } ?>
				<?php if($show_product_total_price) { ?>
				<td class="text-right"><?php echo $column_total; ?></td>
				<?php $colspan += 1; ?>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($products as $product) { ?>
			<tr>
				<?php if($show_product_image) { ?>
				<td class="text-center"><?php if ($product['thumb']) { ?>
					<a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-thumbnail" /></a>
					<?php } ?></td>
				<?php } ?>
				<?php if($show_product_name) { ?>
				<td class="text-left"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
					<?php if (!$product['stock']) { ?>
					<span class="text-danger">***</span>
					<?php } ?>
					<?php if ($product['option']) { ?>
					<?php foreach ($product['option'] as $option) { ?>
					<br />
					<small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
					<?php } ?>
					<?php } ?>
					<?php if ($product['reward']) { ?>
					<br />
					<small><?php echo $product['reward']; ?></small>
					<?php } ?>
					<?php if ($product['recurring']) { ?>
					<br />
					<span class="label label-info"><?php echo $text_recurring_item; ?></span> <small><?php echo $product['recurring']; ?></small>
					<?php } ?></td>
				<?php } ?>
				<?php if($show_product_model) { ?>
				<td class="text-left"><?php echo $product['model']; ?></td>
				<?php } ?>
				<?php if($show_product_quantity) { ?>
				<td class="text-left">
					<?php if ($qty_update_permission) { ?>
					<div class="extinput-group">
						<span class="extbtn-block">
							<button type="button" data-toggle="tooltip" title="<?php echo $button_update; ?>" class="btn btn-primary" onclick="updateOnepageCart('<?php echo $product['cart_id']; ?>');"><i class="fa fa-refresh"></i></button>
						</span>
						<input type="text" name="quantity[<?php echo $product['cart_id']; ?>]" value="<?php echo $product['quantity']; ?>" size="1" rel="<?php echo $product['cart_id']; ?>" class="formcontrol quantitybox" />
						<span class="extbtn-block">
							<button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger" onclick="removeOnepageCart('<?php echo $product['cart_id']; ?>');"><i class="fa fa-times-circle"></i></button>
						</span>
					</div>
					<?php } else{ ?>
					<?php echo $product['quantity']; ?>
					<?php } ?>
				</td>
				<?php } ?>
				<?php if($show_product_unit) { ?>
				<td class="text-right"><?php echo $product['price']; ?></td>
				<?php } ?>
				<?php if($show_product_total_price) { ?>
				<td class="text-right"><?php echo $product['total']; ?></td>
				<?php } ?>
			</tr>
			<?php } ?>
			<?php foreach ($vouchers as $voucher) { ?>
			<tr>
				<td></td>
				<td class="text-left"><?php echo $voucher['description']; ?></td>
				<td class="text-left"></td>
				<td class="text-left"><div class="input-group btn-block" style="max-width: 200px;">
						<input type="text" name="" value="1" size="1" disabled="disabled" class="form-control" />
						<span class="input-group-btn">
						<button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger" onclick="removeOnepageCartVoucher('<?php echo $voucher['key']; ?>');"><i class="fa fa-times-circle"></i></button>
						</span></div>
				</td>
				<td class="text-right"><?php echo $voucher['amount']; ?></td>
				<td class="text-right"><?php echo $voucher['amount']; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td colspan="6"></td>
			</tr>
			<?php foreach ($totals as $total) { ?>
			<tr>
				<td colspan="<?php echo ($colspan) ? $colspan - 1 : 0 ; ?>" class="noborder text-right"><strong><?php echo $total['title']; ?>:</strong></td>
				<td class="noborder text-right"><?php echo $total['text']; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	
</div>
<div class="extrow">
		<div class="extsm-12"><div id="voucher-coupon-reward-error"></div></div>
		<?php echo $coupon_module; ?>
		<?php echo $voucher_module; ?>
	</div>				
	<div class="extrow">
		<?php echo $reward_module; ?>
	</div>
</div>
<script type="text/javascript"><!--
$('#onepagecheckout .quantitybox').keypress(function(event) {
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '13') {
		updateOnepageCart($(this).attr('rel'));
	}
});

function updateOnepageCart(key){
	var quantity = $('#onepagecheckout input[name=\'quantity['+ key +']\']').val();
	$.ajax({
		url: 'index.php?route=onepagecheckout/cart/edit',
		type: 'post',
		data: 'key=' + key + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
		dataType: 'json',
		beforeSend: function() {
			$('#cart > button').button('loading');
		},
		complete: function() {
			$('#cart > button').button('reset');
		},
		success: function(json){
			// Need to set timeout otherwise it wont update the total
			setTimeout(function (){
				$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
			}, 100);

			$('#cart > ul').load('index.php?route=common/cart/info ul li');
			
			// Load Cart
			LoadCart();
			<?php if($logged){ ?>
				LoadPaymentMethod(true);
			<?php }else{ ?>
				LoadPaymentMethod(false);
			<?php } ?>
			LoadShippingMethod();
			var account_type = ($('#onepagecheckout input[name=\'account_type\']:checked').val()) ? $('#onepagecheckout input[name=\'account_type\']:checked').val() : '';
			LoadConfirmation(account_type);
		}
	});
}

function removeOnepageCart(key){
	$.ajax({
		url: 'index.php?route=checkout/cart/remove',
		type: 'post',
		data: 'key=' + key,
		dataType: 'json',
		beforeSend: function() {
			$('#cart > button').button('loading');
		},
		complete: function() {
			$('#cart > button').button('reset');
		},
		success: function(json) {
			// Need to set timeout otherwise it wont update the total
			setTimeout(function () {
				$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
			}, 100);

			$('#cart > ul').load('index.php?route=common/cart/info ul li');
			
			// Load Cart
			LoadCart();
			<?php if($logged){ ?>
				LoadPaymentMethod(true);
			<?php }else{ ?>
				LoadPaymentMethod(false);
			<?php } ?>
			LoadShippingMethod();
			var account_type = ($('#onepagecheckout input[name=\'account_type\']:checked').val()) ? $('#onepagecheckout input[name=\'account_type\']:checked').val() : '';
			LoadConfirmation(account_type);
		}
	});
}

function removeOnepageCartVoucher(key){
	$.ajax({
		url: 'index.php?route=checkout/cart/remove',
		type: 'post',
		data: 'key=' + key,
		dataType: 'json',
		beforeSend: function() {
			$('#cart > button').button('loading');
		},
		complete: function() {
			$('#cart > button').button('reset');
		},
		success: function(json) {
			// Need to set timeout otherwise it wont update the total
			setTimeout(function () {
				$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
			}, 100);

			$('#cart > ul').load('index.php?route=common/cart/info ul li');
			
			// Load Cart
			LoadCart();
			<?php if($logged){ ?>
				LoadPaymentMethod(true);
			<?php }else{ ?>
				LoadPaymentMethod(false);
			<?php } ?>
			LoadShippingMethod();
			var account_type = ($('#onepagecheckout input[name=\'account_type\']:checked').val()) ? $('#onepagecheckout input[name=\'account_type\']:checked').val() : '';
			LoadConfirmation(account_type);
		}
	});
}
//--></script>
<?php }else{ ?>
<script type="text/javascript"><!--
location = '<?php echo $redirect; ?>';
//--></script>
<?php } ?>