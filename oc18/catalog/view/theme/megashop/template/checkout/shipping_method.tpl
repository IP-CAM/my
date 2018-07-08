<?php if ($error_warning) { ?>
<div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($shipping_methods) { ?>
<?php foreach ($shipping_methods as $shipping_method) { ?>
<?php if (!$shipping_method['error']) { ?>
<?php foreach ($shipping_method['quote'] as $quote) { ?>
<div style="margin-bottom:15px; background:#F9F9F9; border:1px #EEE solid;">
	<label style="display:block; padding:20px; margin:0px; cursor:pointer;">
		<?php if ($quote['code'] == $code || !$code) { ?>
		<?php $code = $quote['code']; ?>
		<input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" checked="checked" />
		<?php } else { ?>
		<input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" />
		<?php } ?>
		<?php echo $quote['title']; ?> - <?php echo $quote['text']; ?>
		<?php if (!empty($quote['description'])) { ?>
		<p style="padding-left:20px; font-weight:normal; color:#999;"><?php echo $quote['description']; ?></p>
		<?php } ?>
		<?php if (!empty($shipping_method['description'])) { ?>
		<p style="padding-left:20px; font-weight:normal; color:#999;"><?php echo $shipping_method['description']; ?></p>
		<?php } ?>
	</label>
</div>
<?php } ?>
<?php } else { ?>
<div class="alert alert-danger"><?php echo $shipping_method['error']; ?></div>
<?php } ?>
<?php } ?>
<?php } ?>
