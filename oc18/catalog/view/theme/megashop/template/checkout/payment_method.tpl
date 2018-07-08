<?php if ($error_warning) { ?>
<div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($payment_methods) { ?>
<?php foreach ($payment_methods as $payment_method) { ?>
<div style="margin-bottom:15px; background:#F9F9F9; border:1px #EEE solid; overflow:hidden;">
  <label style="display:block; padding:20px; margin:0px; cursor:pointer;">
    <?php if ($payment_method['code'] == $code || !$code) { ?>
    <?php $code = $payment_method['code']; ?>
    <input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" checked="checked" />
    <?php } else { ?>
    <input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" />
    <?php } ?>
    <?php echo $payment_method['title']; ?>
    <?php if ($payment_method['terms']) { ?>
    <p style="padding-left:20px; font-weight:normal; color:#999;"><?php echo $payment_method['terms']; ?></p>
    <?php } ?>
	<?php if (!empty($payment_method['description'])) { ?>
	<p style="padding-left:20px; font-weight:normal; color:#999;"><?php echo $payment_method['description']; ?></p>
	<?php } ?>
  </label>
</div>
<?php } ?>
<?php } ?>
