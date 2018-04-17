<?php echo $header; ?>
<?php if ($error_warning) { ?>
	<div class="alert alert-danger"><?php echo $error_warning; ?></div>
<?php } ?>
  <?php echo $content_top; ?>
  <?php echo $column_left; ?>
  <?php echo $column_right; ?>
  <?php echo $d_quickcheckout; ?>
  <?php echo $content_bottom; ?>
<?php echo $footer; ?>